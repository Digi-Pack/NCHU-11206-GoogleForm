<script>
import add from '/resources/images/add_circle.png';
import image from '/resources/images/image.png';
import upload from '/resources/images/upload.png';
import video from '/resources/images/video.png';
import view_agenda from '/resources/images/view_agenda.png';
import text from '/resources/images/text.png';
import short_text from '/resources/images/short_text.png';
import long_text from '/resources/images/long_text.png';
import radio_button from '/resources/images/radio_button_checked.png';
import circle_down from '/resources/images/circle_down.png';
import cloud_upload from '/resources/images/cloud_upload.png';
import date from '/resources/images/date.png';
import time from '/resources/images/time.png';
import dots from '/resources/images/dots.png';
import check_box from '/resources/images/check_box.png';
import arrow_down from '/resources/images/arrow_down.png';
import del from '/resources/images/del.png';
import copy from '/resources/images/copy.png';
import close from '/resources/images/close.svg';
import save from '/resources/images/save.svg';
import send from '/resources/images/send.svg';
import { questionTypeOption } from '@/Composables/useQuestionType';
import Swal from 'sweetalert2';
import { router } from '@inertiajs/vue3';
import UploadYtVideo from '@/Components/Modal/UploadYtVideo.vue';

export default {
  components: { UploadYtVideo },
  props: {
    response: Object,
  },
  emits: ['update:qu_title', 'videoUrl'],
  data() {
    return {
      add: add,
      image: image,
      upload: upload,
      video: video,
      view_agenda: view_agenda,
      text: text,
      short_text: short_text,
      long_text: long_text,
      radio_button: radio_button,
      circle_down: circle_down,
      cloud_upload: cloud_upload,
      date: date,
      time: time,
      dots: dots,
      check_box: check_box,
      arrow_down: arrow_down,
      del: del,
      copy: copy,
      close: close,
      save: save,
      send: send,
      questionTypeOption,
      userInformation: this.response,
      formText: {
        modified_at: '',
        other_modified: '',
        opened_date: '',
        lead_author_id: '',
        qu_naires_title: '未命名的表單',
        qu_naires_desc: '表單說明',
      },
      formData: [{
        id: 1,
        title: '問題',
        request: false,
        image: '',
        video: '',
        type: 3,
        options: [
          {
            id: 1,
            value: '',
          },
        ],
        linear: {
          min: 1,
          max: 10,
          minText: '',
          maxText: '',
        },
        square: {
          row: [
            {
              id: 1,
              text: '',
            },
          ],
          column: [
            {
              id: 1,
              text: '',
            },
          ],
        },
      }],
      serial: 1,
      selectedMin: '0',
      selectedMax: '2',
      show: false,
      model: '123',
      isSidebarFixed: false,
      formUrl: '',
      imageSize: 0,
      scrollHeight: 0,
      interval: null,
    };
  },
  watch: {
    formText: {
      handler(newValue) {
        sessionStorage.setItem('formText', JSON.stringify(newValue));
      },
      deep: true,
    },
    formData: {
      handler(newValue) {
        sessionStorage.setItem('formData', JSON.stringify(newValue));
      },
      deep: true,
    },
  },
  mounted() {
    if (!sessionStorage.getItem('formText')) {
      sessionStorage.setItem('formText', JSON.stringify(this.formText));
    }
    else {
      this.formText = JSON.parse(sessionStorage.getItem('formText'));
    }
    if (!sessionStorage.getItem('formData')) {
      sessionStorage.setItem('formData', JSON.stringify(this.formData));
    }
    else {
      this.formData = JSON.parse(sessionStorage.getItem('formData'));
    }
    window.addEventListener('scroll', this.handleScroll);
    this.$parent.formTitle = this.formText.qu_naires_title;
  },
  unmounted() {
    window.removeEventListener('scroll', this.handleScroll);
  },
  methods: {
    // 新增問題
    addQuestion() {
      const { formData } = this;
      this.serial++;
      const newQuestion = {
        id: this.serial,
        title: '問題',
        request: false,
        image: '',
        video: '',
        type: 3,
        options: [
          {
            id: 1,
            value: '',
          },
        ],
        linear: {
          min: 1,
          max: 10,
          minText: '',
          maxText: '',
        },
        square: {
          row: [
            {
              id: 1,
              text: '',
            },
          ],
          column: [
            {
              id: 1,
              text: '',
            },
          ],
        },
      };
      formData.push(newQuestion);
    },
    // 刪除問題
    delQuestion(id) {
      const { formData } = this;
      const newFormData = formData.filter((item) => item.id !== id);
      this.formData = newFormData;
    },
    // 新增選擇項目
    addSelect(item) {
      const newQuestion = {
        id: Math.max(0, ...item.options.map(item => item.id)) + 1,
        value: '',
      };
      item.options.push(newQuestion);
    },
    // 刪除選擇項目
    delOption(item, id) {
      const newFormData = item.options.filter((item) => item.id !== id);
      item.options = newFormData;
    },
    // 新增行
    addrow(item, id) {
      const { formData } = this;
      const squareRow = {
        id: Math.max(0, ...item.square.row.map(item => item.id)) + 1,
        text: '',
      };
      formData.find((item) => item.id === id).square.row.push(squareRow);
    },
    // 刪除行
    delrow(item, id) {
      const newFormData = item.square.row.filter((item) => item.id !== id);
      item.square.row = newFormData;
    },
    // 新增列
    addcolumn(item, id) {
      const { formData } = this;
      const squareColumn = {
        id: Math.max(0, ...item.square.column.map(item => item.id)) + 1,
        text: '',
      };
      formData.find((item) => item.id === id).square.column.push(squareColumn);
    },
    // 刪除列
    delcolumn(item, id) {
      const newFormData = item.square.column.filter((item) => item.id !== id);
      item.square.column = newFormData;
    },
    // 切換問題類型時清空資料
    clearOptions(item) {
      let optionsLength = item.options.length;
      let squarerow = item.square.row.length;
      let squarecolumn = item.square.column.length;
      const newQuestion = {
        id: 1,
        value: '',
      };
      const squareRow = {
        id: 1,
        text: '',
      };
      const squareColumn = {
        id: 1,
        text: '',
      };
      const linears = {
        min: 1,
        max: 10,
        minText: '',
        maxText: '',
      };
      item.options.splice(0, optionsLength, newQuestion);
      item.square.row.splice(0, squarerow, squareRow);
      item.square.column.splice(0, squarecolumn, squareColumn);
      item.linear = linears;
    },
    // 儲存表單
    submitData() {
      const { formData, formText } = this;
      if (this.imageSize > 3145728)
        return Swal.fire('圖片檔案過大');
      // 驗證
      router.visit(route('edit.store'), {
        method: 'post', data: { formData, formText }, preserveState: true,
        onSuccess: ({ props }) => {
          if (props.flash.message.rt_code === 1) {
            this.formUrl = props.flash.message.rt_data;
            sessionStorage.removeItem('formData');
            sessionStorage.removeItem('formText');
            Swal.fire({
              title: '新增成功，請按傳送',
              showDenyButton: true,
              confirmButtonText: '回列表',
              denyButtonText: '繼續編輯',
            }).then((result) => {
              if (result.isConfirmed) {
                router.get(route('guide.index'));
              }
              if (result.isDenied) {
                router.visit(route('edit.old'), {
                  method: 'get', data: { id: props.flash.message.rt_data.id },
                });
              }
            });
          }
        },
      });
    },
    // 打開傳送彈跳視窗
    open() {
      this.show = !this.show;
    },
    testStyle(index, err = {}) {
      return Object.hasOwn(err, `formData.${index}.title`) ? '!border-[red]' : '';
    },
    // 上傳圖片
    uploadImage(event, item) {
      const reader = new FileReader();
      reader.readAsDataURL(event.target.files[0]);
      reader.onload = () => {
        item.image = reader.result;
        this.imageSize += event.target.files[0].size;
      };
    },
    // 側欄滾動
    handleScroll() {
      this.$refs.side.style.top = window.scrollY + this.interval + 'px';
    },
    updateFormTitle() {
      // 当qu_naires_title属性发生变化时，同时更新this.$parent.formTitle
      this.$parent.formTitle = this.formText.qu_naires_title;
    },
    // 側欄增加圖片區塊
    addImage(e) {
      const { formData } = this;
      this.serial++;
      const newQuestion = {
        id: this.serial,
        title: '問題',
        request: false,
        image: '',
        video: '',
        type: 12,
        options: [
          {
            id: 1,
            value: '',
          },
        ],
        linear: {
          min: 1,
          max: 10,
          minText: '',
          maxText: '',
        },
        square: {
          row: [
            {
              id: 1,
              text: '',
            },
          ],
          column: [
            {
              id: 1,
              text: '',
            },
          ],
        },
      };
      const reader = new FileReader();
      reader.readAsDataURL(e.target.files[0]);
      if (this.imageSize > 3145728) return Swal.fire('表單內圖片已達上限');
      if (e.target.files[0].size > 314572) return Swal.fire('圖片檔案過大');
      formData.push({ ...newQuestion });
      reader.onload = () => {
        formData[formData.length - 1].image = reader.result;
        this.imageSize += e.target.files[0].size;
      };
    },
    // 關閉彈跳視窗
    handleClose() {
      this.model = '';
    },
    // 測欄增加影片
    addVideo(newVideo) {
      const { formData } = this;
      this.serial++;
      const newQuestion = {
        id: this.serial,
        title: '問題',
        request: false,
        image: '',
        video: `${newVideo}`,
        type: 13,
        options: [
          {
            id: 1,
            value: '',
          },
        ],
        linear: {
          min: 1,
          max: 10,
          minText: '',
          maxText: '',
        },
        square: {
          row: [
            {
              id: 1,
              text: '',
            },
          ],
          column: [
            {
              id: 1,
              text: '',
            },
          ],
        },
      };
      formData.push(newQuestion);
    },
  },
};
</script>

<template>
  <input hidden type="text" v-model="userInformation">
  <section id="question" class="pt-[10px] z-2" ref="main">
    <div class="container">
      <form class="w-[840px] tablet:w-full flex justify-between tablet:justify-center" @submit.prevent="submitData()">
        <!-- 表單命名處 -->
        <div class="w-[770px] tablet:w-full">
          <div class="form-title">
            <!-- 表單名稱 -->
            <input v-model="formText.qu_naires_title" type="text" placeholder="未命名的表單" class="form-input form-title-input truncate" required @input="updateFormTitle">
            <!-- 表單說明 -->
            <input v-model="formText.qu_naires_desc" type="text" placeholder="表單說明" class="form-input form-explain-input-2 truncate">
          </div>
          <!-- 問題設置 -->
          <div v-for="item in formData" :key="item.id" class="question">
            <!-- 側欄新增圖片 -->
            <div v-if="item.type === 12">
              <div class="question-bottom">
                {{ imageSize }}
                <div class="func !border-r-0">
                  <input :value="item.title" type="text" placeholder="圖片標題" class="border-0 w-full h-[55px] duration-200 placeholder:text-black focus:ring-0 focus:bg-grey-light focus:border-b-[3px] focus:border-b-purple">
                  <button type="button" @click="delQuestion(item.id)">
                    <label>
                      <img :src="del" alt="">
                    </label>
                  </button>
                </div>
              </div>
              <div class="p-5">
                <img :src="item.image" class="w-full aspect-[5/3] object-cover" alt="">
              </div>
            </div>
            <!-- 側欄新增影片 -->
            <div v-else-if="item.type === 13">
              <div class="question-bottom">
                <div class="func !border-r-0">
                  <input :value="item.title" type="text" placeholder="影片標題" class="border-0 w-full h-[55px] duration-200 placeholder:text-black focus:ring-0 focus:bg-grey-light focus:border-b-[3px] focus:border-b-purple">
                  <button type="button" @click="delQuestion(item.id)">
                    <label>
                      <img :src="del" alt="">
                    </label>
                  </button>
                </div>
              </div>
              <div class="p-5 flex justify-center">
                <iframe class="max-w-[600px] w-[90%] h-[400px]" :src="item.video" title="YouTube video player" frameborder="0" allowfullscreen></iframe>
              </div>
            </div>
            <!-- 一般問題類型 -->
            <div v-else>
              <!-- 第一行 -->
              <div class="question-top">
                <div class="text-box">
                  <input v-model="item.title" type="text" placeholder="問題" class="form-input form-title-input focus:ring-0 focus:bg-white" required>
                </div>
                <label>
                  <img :src="image" alt="" class="upload">
                  <input type="file" id="image" @change="(event) => uploadImage(event, item)" hidden>
                </label>
                <!-- 下拉選單 -->
                <div class="check">
                  <select v-model="item.type" class="answer-type" name="" @change="clearOptions(item)">
                    <option v-for="items in questionTypeOption" :key="items.id" :value="items.id">{{ items.name }}
                    </option>
                  </select>
                </div>
              </div>
              <!-- 問題框內圖片 -->
              <div class="p-5">
                <img v-if="item.image" :src="item.image" class="w-full aspect-[5/3] object-cover" alt="">
              </div>
              <!-- 第二行 第一種 簡答 -->
              <div v-if="item.type === 1" class="questype-1 !block">
                <div class="short">簡答文字</div>
              </div>
              <!-- 第二行 第二種 詳答 -->
              <div v-if="item.type === 2" class="questype-2 !block">
                <div class="long">詳答文字</div>
              </div>
              <!-- 第二行 第三種 選擇題 -->
              <div v-if="item.type === 3" class="questype-3">
                <div v-for="(option, index) in item.options" :key="option.id" class="choose">
                  <input type="checkbox" id="checkbox">
                  <label for="checkbox" class="checkbox"></label>
                  <input type="text" class="choose_line placeholder:text-black" :placeholder="'選項' + (index + 1)" v-model="option.value">
                  <button type="button" class="w-[22px]" @click="delOption(item, option.id)"><img :src="close" class="hover:bg-[#dddddd] hover:scale-110 rounded-full" alt=""></button>
                </div>
                <div class="choose">
                  <input type="checkbox" id="checkbox2">
                  <label for="checkbox2" class="checkbox"></label>
                  <button type="button" class="ml-[10px] mr-[5px] text-gray-500 text-[15px]" @click="addSelect(item)">新增選項</button>
                </div>
              </div>
              <!-- 第二行 第四種 核取方塊 -->
              <div v-if="item.type === 4" class="questype-4 !block">
                <div v-for="(option, index) in item.options" :key="option.id" class="choose">
                  <input type="checkbox" class="pointer-events-none">
                  <input type="text" class="choose_line placeholder:text-black" :placeholder="'選項' + (index + 1)" v-model="option.value">
                  <button type="button" class="w-[22px]" @click="delOption(item, option.id)"><img :src="close" class="hover:bg-[#dddddd] hover:scale-110 rounded-full" alt=""></button>
                </div>
                <div class="choose">
                  <input type="checkbox" class="pointer-events-none">
                  <button type="button" class="ml-[20px] mr-[5px] text-[15px] text-gray-500" @click="addSelect(item)">新增選項</button>
                </div>
              </div>
              <!-- 第二行 第五種 下拉式選單 -->
              <div v-if="item.type === 5" class="questype-5 !block">
                <div v-for="(option, index) in item.options" :key="option.id" class="choose">
                  {{ index + 1 }}<span>。</span><input type="text" class="choose_line placeholder:text-black" :placeholder="'選項' + (index + 1)" v-model="option.value">
                  <button type="button" class="w-[22px]" @click="delOption(item, option.id)"><img :src="close" class="hover:bg-[#dddddd] hover:scale-110 rounded-full" alt=""></button>
                </div>
                <div class="choose">
                  {{ item.options.length + 1 }}<span>。</span><button type="button" class="ml-[10px] mr-[5px] text-gray-500 text-[15px]" @click="addSelect(item)">新增選項</button>
                </div>
              </div>
              <!-- 第二行 第六種  檔案上傳 -->
              <div v-if="item.type === 6" class="questype-6 !block">
                <h3>作答者可將檔案上傳到表單</h3>
                <span> 在表單中新增檔案上傳問題後。請務必只與你信任的對象共用這份表單。</span>
              </div>
              <!-- 第二行 第七種 線性刻度 -->
              <div v-if="item.type === 7" class="questype-7 !block">
                <!-- 範圍設定 -->
                <select v-model="item.linear.min" name="min">
                  <option value="0">0</option>
                  <option value="1">1</option>
                </select>
                <span>到</span>
                <select v-model="item.linear.max" name="max">
                  <option value="2">2</option>
                  <option value="3">3</option>
                  <option value="4">4</option>
                  <option value="5">5</option>
                  <option value="6">6</option>
                  <option value="7">7</option>
                  <option value="8">8</option>
                  <option value="9">9</option>
                  <option value="10">10</option>
                </select>
                <!-- 最大值與最小值意義設定 -->
                <div class="num-mean">
                  <div class="min">
                    <span>{{ item.linear.min }}</span>
                    <input type="text" class="num-mean-input" v-model="item.linear.minText" placeholder="標籤(選填)">
                  </div>
                  <div class="max">
                    <span>{{ item.linear.max }}</span>
                    <input type="text" class="num-mean-input" v-model="item.linear.maxText" placeholder="標籤(選填)">
                  </div>
                </div>
              </div>
              <!-- 第二行 第八種  單選方格 -->
              <div v-if="item.type === 8" class="questype-8 !block">
                <div class="left_right">
                  <div class="left">
                    <div>列</div>
                    <div v-for="(row, index) in item.square.row" :key="row.id" class="choose">
                      {{ index + 1 }}<span>。</span>
                      <input type="text" class="choose_line placeholder:text-black" :placeholder="'選項' + (index + 1)" v-model="row.text">
                      <button type="button" @click="delrow(item, row.id)">
                        <img :src="close" class="hover:bg-[#dddddd] hover:scale-110 rounded-full" alt="">
                      </button>
                    </div>
                    <div class="choose">
                      {{ item.square.row.length + 1 }}<span>。</span><button type="button" @click="addrow(item, item.id)" class="text-gray-500 text-[15px] ml-[9px]">新增列</button>
                    </div>
                  </div>
                  <div class="right">
                    <div>欄</div>
                    <div v-for="(column, index) in item.square.column" :key="column.id" class="choose">
                      <div class="checkbox"></div>
                      <input type="text" class="choose_line placeholder:text-black" :placeholder="'選項' + (index + 1)" v-model="column.text">
                      <button type="button" @click="delcolumn(item, column.id)">
                        <img :src="close" class="hover:bg-[#dddddd] hover:scale-110 rounded-full" alt="">
                      </button>
                    </div>
                    <div class="choose">
                      <div class="checkbox"></div>
                      <button type="button" @click="addcolumn(item, item.id)" class="ml-3 text-gray-500 text-[15px]">新增欄</button>
                    </div>
                  </div>
                </div>
              </div>
              <!-- 第二行 第九種  核取方塊格 -->
              <div v-if="item.type === 9" class="questype-9 !block">
                <div class="left_right">
                  <div class="left">
                    <div>列</div>
                    <div v-for="(row, index) in item.square.row" :key="row.id" class="choose">
                      {{ index + 1 }}<span>。</span>
                      <input type="text" class="choose_line placeholder:text-black" :placeholder="'選項' + (index + 1)" v-model="row.text">
                      <button type="button" @click="delrow(item, row.id)">
                        <img :src="close" class="hover:bg-[#dddddd] hover:scale-110 rounded-full" alt="">
                      </button>
                    </div>
                    <div class="choose">
                      {{ item.square.row.length + 1 }}<span>。</span><button type="button" class="text-gray-500 text-[15px] ml-[9px]" @click="addrow(item, item.id)">新增列</button>
                    </div>
                  </div>
                  <div class="right">
                    <div>欄</div>
                    <div v-for="(column, index) in item.square.column" :key="column.id" class="choose">
                      <input type="checkbox" class="pointer-events-none">
                      <input type="text" class="choose_line placeholder:text-black" :placeholder="'選項' + (index + 1)" v-model="column.text">
                      <button type="button" @click="delcolumn(item, column.id)">
                        <img :src="close" class="hover:bg-[#dddddd] hover:scale-110 rounded-full" alt="">
                      </button>
                    </div>
                    <div class="choose">
                      <input type="checkbox" class="pointer-events-none">
                      <button type="button" @click="addcolumn(item, item.id)" class="ml-3 text-gray-500 text-[15px]">新增欄</button>
                    </div>
                  </div>
                </div>
              </div>
              <!-- 第二行 第十種  日期 -->
              <div v-if="item.type === 10" class="questype-10 !block">
                <div class="calender">日期<img :src="date" alt=""></div>
              </div>
              <!-- 第二行 第十一種  時間 -->
              <div v-if="item.type === 11" class="questype-11 !block">
                <input type="time" hidden>
                <div class="clock">時間<img :src="time" alt=""></div>
              </div>
              <!-- 第三行 -->
              <div class="question-bottom">
                <div class="func">
                  <button type="button" @click="delQuestion(item.id)">
                    <label>
                      <img :src="del" alt="">
                    </label>
                  </button>
                </div>
                <!-- 必填選項開關 -->
                <div class="switch">
                  <label>
                    <span class="text">必填</span>
                    <input v-model="item.request" type="checkbox" name="" id="" class="checkbox">
                    <div class="btn-box">
                      <span class="btn"></span>
                    </div>
                  </label>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- 側欄 -->
        <div class="flex flex-col justify-start gap-10 relative duration-500 self-start" ref="side">
          <div class="side">
            <button type="button" class="side-func" @click="addQuestion()">
              <label class="cursor-pointer">
                <img :src="add" alt="">
              </label>
              <span>新增問題</span>
            </button>
            <input type="file" id="addImage" class="hidden" @change="(e) => addImage(e)">
            <label for="addImage" class="side-func !rounded-none cursor-pointer">
              <div>
                <img :src="image" alt="">
                <span>新增圖片</span>
              </div>
            </label>
            <button type="button" class="side-func !rounded-none" @click="model = 'UploadYtVideo'">
              <img :src="video" alt="">
              <span>新增影片</span>
            </button>
            <button type="submit" class="side-func bg-purple-dark hover:!bg-purple-middle">
              <img :src="save" alt="">
              <span>儲存表單</span>
            </button>
            <button type="button" class="side-func bg-purple-dark hover:!bg-purple-middle" @click="open()">
              <img :src="send" alt="">
              <span>傳送</span>
            </button>
          </div>
          <SendLinkModal v-if="show" :form-url="formUrl">
          </SendLinkModal>
          <UploadYtVideo v-if="model === 'UploadYtVideo'" @close-model="handleClose" @video-url="addVideo">
          </UploadYtVideo>
        </div>
      </form>
    </div>
  </section>
</template>

<style lang="scss" scoped>
#question {
    @apply min-h-[100vh] pl-[70px] tablet:pl-0;
    .container {
        @apply max-w-[840px] min-h-full m-auto relative flex justify-between mt-[30px] pb-[20px] tablet:mt-0 tablet:max-w-full tablet:items-center;
        .side {
            @apply w-[49px] h-[210px] flex flex-col bg-white rounded-[10px] shadow tablet:fixed tablet:flex-row tablet:justify-around tablet:h-[60px] tablet:w-[98%] tablet:top-[calc(100%-60px)] tablet:left-2 tablet:items-center;
            img {
                @apply w-[22px];
            }
            .side-func {
                @apply flex justify-center items-center relative py-[10px] hover:bg-blue-light tablet:w-full tablet:h-full;

                &:hover span {
                    @apply block;
                }

                &:nth-of-type(1) {
                    @apply rounded-tl-[10px] rounded-tr-[10px] tablet:rounded-bl-[10px] tablet:rounded-tr-none;
                }

                &:nth-of-type(4) {
                    @apply rounded-bl-[10px] rounded-br-[10px] tablet:rounded-bl-none tablet:rounded-tr-[10px];
                }

                span {
                    @apply hidden absolute w-auto whitespace-nowrap p-[6px] bg-gray-500 text-white text-xs rounded-[3px] top-[10px] left-[60px] tablet:-top-9 tablet:left-9;
                }
            }
        }
        .form-title {
            @apply w-[770px] tablet:w-full rounded-[10px] border-t-[10px] border-l-[10px] border-l-purple border-t-purple pt-[22px] pb-[24px] bg-white;
            .form-input {
                @apply border-x-0 border-t-0 border-b-gray-400 w-[91%] font-semibold my-2 mx-[25px] focus:border-b-[3px] focus:border-b-purple focus:ring-0;
            }
            .form-title-input {
                @apply h-[45px] text-[32px];
            }
            .form-explain-input-2 {
                @apply h-[21px] text-[18px] text-grey;
            }
        }
        .question {
            @apply rounded-[10px] border-l-[10px] border-l-purple p-[24px] my-[12px] bg-white tablet:w-full;
            .question-top {
                @apply flex flex-wrap justify-between items-center;
                @media (max-width:435px) {
                    flex-direction: column;
                    align-items: start;
                }
                .upload {
                    @apply w-[41.6px] h-[41.6px] p-[10px] mt-[8px] cursor-pointer hover:bg-gray-100 rounded-[50%];
                }
                .text-box {
                    @apply w-[447px] mt-[10px];
                    @media(max-width:770px) {
                        width: 90%;
                    }
                    @media(max-width:435px) {
                        width: 100%;
                    }
                    .form-title-input {
                        @apply border-x-0 border-t-0 border-b-gray-400 w-full h-[56px] text-base font-semibold focus:bg-gray-50 focus:border-b-[3px] focus:border-b-purple focus:ring-0 rounded-tl-[10px] rounded-tr-[10px];
                    }
                }
                .check {
                    @apply relative mt-[10px];
                    @media(max-width:435px) {
                        margin-left: 10px;
                    }
                    .answer-type {
                        @apply w-[209px] border border-grey rounded-[10px] overflow-y-scroll;
                    }
                }
            }
            .questype-1 {
                @apply pt-[20px] pb-[35px] hidden border-b border-grey;
                .short {
                  @apply w-[60%] text-[16px] font-semibold text-grey border-b border-grey border-dotted;
                }
            }
            .questype-2 {
                @apply pt-[20px] pb-[35px] hidden border-b border-grey;
                .long {
                  @apply w-[85%] text-[16px] font-semibold text-grey border-b border-grey border-dotted;
                }
            }
            .questype-3 {
                @apply w-full py-[30px] border-b border-grey;
                .choose {
                  @apply w-full flex items-center mb-[10px];
                    #checkbox,
                    #checkbox2 {
                      @apply hidden;
                    }
                    .checkbox {
                      @apply w-[24px] h-[24px] inline-block rounded-full border-[2px] border-grey mr-[5px];
                    }
                    .choose_line {
                      @apply w-[80%] border-0 h-[30px] text-[16px] font-medium hover:border-b hover:border-grey focus:border-b-[3px] focus:border-b-purple focus:ring-0;
                    }
                    a {
                      @apply text-blue no-underline;
                    }
                }
            }
            .questype-4 {
              @apply w-full py-[30px] border-b border-grey hidden;
                .choose {
                  @apply w-full flex items-center mb-[10px];

                    #checkbox,
                    #checkbox2 {
                      @apply w-[24px] h-[24px] mr-[5px] pointer-events-none;
                    }
                    .choose_line {
                      @apply w-[80%] border-0 h-[30px] ml-2 text-[16px] font-medium hover:border-b hover:border-grey focus:border-b-[3px] focus:border-[#673ab7] focus:ring-0;
                    }
                    a {
                      @apply text-blue no-underline;
                    }
                }
            }
            .questype-5 {
              @apply hidden w-full py-[30px] border-b border-grey;
                .choose {
                  @apply w-full flex items-center mb-[10px];
                    span {
                      @apply pt-[12px];
                    }
                    .choose_line {
                      @apply w-[80%] border-0 h-[30px] text-[16px] font-medium hover:border-b hover:border-grey focus:ring-0 focus:border-b-[3px] focus:border-b-purple;
                    }
                }
            }
            .questype-6 {
              @apply w-full hidden py-[10px];

                div {
                  @apply p-[20px] w-full flex justify-center;

                    a {
                      @apply text-blue no-underline;
                    }
                }
            }
            .questype-7 {
                @apply w-full border-x-0 border-t-0 border-b border-b-grey pb-[30px] hidden;
                select {
                    @apply border-0;
                }
                .num-mean {
                    @apply text-grey text-base font-semibold;
                }
                .num-mean-input {
                    @apply border-x-0 border-t-0 border-b border-b-grey w-[200px] h-[40px] text-base text-grey font-semibold my-2 mx-[25px] focus:border-b-[3px] focus:border-b-purple ring-0;
                }
            }
            .questype-8, .questype-9 {
                @apply w-full hidden;
                .left_right {
                    @apply w-full flex;
                    .right,
                    .left {
                        @apply w-1/2 py-[30px] border-x-0 border-t-0 border-b border-b-grey;
                        .choose {
                          @apply w-full flex items-center;
                            span {
                              @apply pt-3;
                            }
                            .choose_line {
                              @apply w-4/5 border-0 h-[40px] text-base font-medium hover:border-b hover:border-b-grey focus:border-x-0 focus:border-t-0 focus:border-b-[3px] focus:border-b-purple focus:ring-0;
                            }
                        }
                    }
                    .right {
                        #checkbox,
                        #checkbox2 {
                          @apply w-6 h-6 mr-[5px] pointer-events-none;
                        }
                        .checkbox {
                          @apply w-[24px] h-[24px] inline-block rounded-full border-[2px] border-grey mr-[5px];
                        }
                    }
                }
            }
            .questype-10 {
                @apply pt-[20px] pb-[35px] hidden border-x-0 border-t-0 border-b border-b-grey;
                .calender {
                    @apply flex justify-between w-[20%] text-base font-semibold text-grey border-x-0 border-t-0 border-b border-dotted border-b-grey;
                    img {
                        @apply w-[22px] h-[22px];
                    }
                }
            }
            .questype-11 {
                @apply pt-[20px] pb-[35px] hidden border-x-0 border-t-0 border-b border-b-grey;
                .clock {
                    @apply flex justify-between w-[20%] text-base font-semibold text-grey border-x-0 border-t-0 border-b border-dotted border-b-grey;
                    img {
                        @apply w-[22px] h-[22px];
                    }
                }
            }

            .question-bottom {
                @apply w-full flex justify-end items-center text-lg font-semibold text-grey pt-[0px] pr-[10px];

                .func {
                    @apply w-full h-[52px] pr-5 flex items-center justify-end border-r border-r-gray-400;

                    img {
                        @apply w-[52px] h-[52px] p-[15px] mr-2.5 cursor-pointer hover:bg-gray-100 rounded-[50%];
                    }
                }

                .switch {
                    @apply w-[130px] ml-[50px];
                    label {
                        @apply w-[85px] flex justify-between items-center;
                    }
                    .btn-box {
                        @apply inline-block align-middle w-[40px] h-[20px] rounded-[100px] bg-grey-middle shadow-inner;
                    }
                    .btn-box .btn {
                        @apply inline-block -translate-y-1 drop-shadow-lg w-[25px] h-[25px] rounded-[50%] bg-white ml-0 transition-[0.5s] shadow-sm;
                    }
                    .checkbox {
                        @apply absolute opacity-0;
                    }
                    .checkbox:checked+.btn-box {
                        @apply bg-blue;
                    }
                    .checkbox:checked+.btn-box .btn {
                        @apply ml-[20px];
                    }
                }
            }
        }
    }
}
</style>


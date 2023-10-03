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
import { questionTypeOption } from '@/Composables/useQuestionType';
import Swal from 'sweetalert2';
import { router } from '@inertiajs/vue3';

export default {
  props: {
    response: Object,
  },
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
      questionTypeOption,
      formText: {
        id: this.response?.rt_data?.responseForm.id ?? '',
        modified_at: '',
        other_modified: '',
        opened_date: '',
        lead_author_id: '',
        qu_naires_title: this.response?.rt_data?.responseForm.qu_naires_title ?? '',
        qu_naires_desc: this.response?.rt_data?.responseForm.qu_naires_desc ?? '',
      },

      formData: this.response?.rt_data?.questionNaires?.map(questionnaire => {
        return {
          id: questionnaire.id,
          title: questionnaire.title,
          request: questionnaire.request,
          image: questionnaire.image,
          video: questionnaire.video,
          type: questionnaire.type,
          options: questionnaire.options.map(option => {
            return {
              id: option.id,
              value: option.value,
            };
          }),
          linear: {
            min: questionnaire.linear.min,
            max: questionnaire.linear.max,
            minText: questionnaire.linear.minText,
            maxText: questionnaire.linear.maxText,
          },
          square: {
            row: questionnaire.square.row.map(rowItem => {
              return {
                id: rowItem.id,
                text: rowItem.text,
              };
            }),
            column: questionnaire.square.column.map(columnItem => {
              return {
                id: columnItem.id,
                text: columnItem.text,
              };
            }),
          },
        };
      }) ?? [],
      a: 1,
      selectedMin: '0',
      selectedMax: '2',
      imageSize: 0,
    };
  },
  methods: {
    addQuestion() {
      const { formData } = this;
      this.a = formData.length + 1;
      const newQuestion = {
        id: this.a,
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
    delQuestion(id) {
      const { formData } = this;
      const newFormData = formData.filter((item) => item.id !== id);
      this.formData = newFormData;
    },
    addSelect(item) {
      const newQuestion = {
        id: Math.max(0, ...item.options.map(item => item.id)) + 1,
        value: '',
      };
      item.options.push(newQuestion);
    },
    delOption(item, id) {
      const newFormData = item.options.filter((item) => item.id !== id);
      item.options = newFormData;
    },
    addrow(item, id) {
      const { formData } = this;
      const squareRow = {
        id: Math.max(0, ...item.square.row.map(item => item.id)) + 1,
        text: '',
      };
      formData.find((item) => item.id === id).square.row.push(squareRow);
    },
    delrow(item, id) {
      const newFormData = item.square.row.filter((item) => item.id !== id);
      item.square.row = newFormData;
    },
    addcolumn(item, id) {
      const { formData } = this;
      const squareColumn = {
        id: Math.max(0, ...item.square.column.map(item => item.id)) + 1,
        text: '',
      };
      formData.find((item) => item.id === id).square.column.push(squareColumn);
    },
    delcolumn(item, id) {
      const newFormData = item.square.column.filter((item) => item.id !== id);
      item.square.column = newFormData;
    },
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
      if (this.imageSize > 3145728) return Swal.fire('圖片檔案過大');
      // 驗證
      router.visit(route('edit.update'), {
        method: 'post', data: { formData, formText }, preserveState: false,
        onSuccess: ({ props }) => {
          if (props.flash.message.rt_code === 1) {
            Swal.fire({
              title: '修改成功',
              showDenyButton: true,
              confirmButtonText: '回列表',
              denyButtonText: '編輯新表單',
            }).then((result) => {
              if (result.isConfirmed) {
                router.get(route('guide.index'));
              } else if (result.isDenied) {
                router.visit(route('edit.index'));
              }
            });
          }
        },
      });
    },
    uploadImage(event, item) {
      const reader = new FileReader();
      reader.readAsDataURL(event.target.files[0]);
      reader.onload = () => {
        item.image = reader.result;
        this.imageSize += event.target.files[0].size;
      };
    },
  },
};

</script>

<template>
  <!-- {{ formData.length }} -->
  <!-- {{ formData }} -->
  <section id="question">
    <div class="container">
      <form @submit.prevent="submitData()">
        <!-- 側欄 -->
        <div class="side">
          <button type="button" class="side-func" @click="addQuestion()">
            <label>
              <img :src="add" alt="">
            </label>
            <span>新增問題</span>
          </button>
          <div class="side-func">
            <img :src="upload" alt="">
            <span>匯入問題</span>
          </div>
          <div class="side-func">
            <img :src="text" alt="">
            <span>新增標題與說明</span>
          </div>
          <div class="side-func">
            <img :src="image" alt="">
            <span>新增圖片</span>
          </div>
          <div class="side-func">
            <img :src="video" alt="">
            <span>新增影片</span>
          </div>
          <div class="side-func">
            <img :src="view_agenda" alt="">
            <span>新增區段</span>
          </div>
        </div>
        <!-- 表單命名處 -->
        <div class="form-title">

          <!-- 表單名稱 -->
          <input v-model="formText.qu_naires_title" :class="{ 'border-[red]': $page.props.errors['formText.qu_naires_title'] }" type="text" placeholder="未命名的表單" class="form-input form-title-input" required>
          <div class="text-[red]">{{ $page.props?.errors['formText.qu_naires_title'] ?? '' }}</div>
          <!-- 表單說明 -->
          <input v-model="formText.qu_naires_desc" type="text" placeholder="表單說明" class="form-input form-explain-input-2">
        </div>

        <!-- 問題設置 -->
        <div v-for="(item, index) in formData" :key="item.id" class="question">
          <!-- 第一行 -->
          <div class="question-top">
            <div class="text-box">
              {{ $page.props?.errors[`formData.${index}.title`] ?? '' }}
              <input v-model="item.title" type="text" :class="{ '!border-[red]': Object.hasOwn($page.props?.errors ?? {}, `formData.${index}.title`) }" placeholder="問題" class="form-input form-title-input" required>
              <div class="text-[red]">{{ $page.props?.errors[`formData.${index}.title`] ?? '' }}</div>
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
          <div>
            <img v-if="item.image" :src="item.image" class="w-[200px] aspect-[4/3] object-cover" alt="">
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
              <input type="text" class="choose_line" :placeholder="'選項' + (index + 1)" v-model="option.value">
              <button type="button" class="w-[22px]" @click="delOption(item, option.id)"><img :src="close" class="hover:bg-[#dddddd] hover:scale-110 rounded-full" alt=""></button>
            </div>
            <div class="choose">
              <input type="checkbox" id="checkbox2">
              <label for="checkbox2" class="checkbox"></label>
              <button type="button" class="ml-[10px] mr-[5px]" @click="addSelect(item)">新增選項</button>
            </div>
          </div>
          <!-- 第二行 第四種 核取方塊 -->
          <div v-if="item.type === 4" class="questype-4 !block">
            <div v-for="(option, index) in item.options" :key="option.id" class="choose">
              <input type="checkbox" id="checkbox">
              <input type="text" class="choose_line" :placeholder="'選項' + (index + 1)" v-model="option.value">
              <button type="button" class="w-[22px]" @click="delOption(item, option.id)"><img :src="close" class="hover:bg-[#dddddd] hover:scale-110 rounded-full" alt=""></button>
            </div>
            <div class="choose">
              <input type="checkbox" id="checkbox2">
              <button type="button" class="ml-[10px] mr-[5px]" @click="addSelect(item)">新增選項</button>
            </div>
          </div>
          <!-- 第二行 第五種 下拉式選單 -->
          <div v-if="item.type === 5" class="questype-5 !block">
            <div v-for="(option, index) in item.options" :key="option.id" class="choose">
              {{ index + 1 }}<span>。</span><input type="text" class="choose_line" :placeholder="'選項' + (index + 1)" v-model="option.value">
              <button type="button" class="w-[22px]" @click="delOption(item, option.id)"><img :src="close" class="hover:bg-[#dddddd] hover:scale-110 rounded-full" alt=""></button>
            </div>
            <div class="choose">
              {{ item.options.length + 1 }}<span>。</span><button type="button" class="ml-[10px] mr-[5px]" @click="addSelect(item)">新增選項</button>
            </div>
          </div>
          <!-- 第二行 第六種  檔案上傳 -->
          <div v-if="item.type === 6" class="questype-6 !block">
            <h3>作答者可將檔案上傳到雲端硬碟</h3>
            <span>  檔案會上傳到表單擁有者的 Google 雲端硬碟。在表單中新增檔案上傳問題後，作答者必須登入 Google 才能回答問題。請務必只與你信任的對象共用這份表單。</span>
            <div><a href="">取消</a><a href="">繼續</a></div>
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
                  <input type="text" class="choose_line" :placeholder="'選項' + (index + 1)" v-model="row.text">
                  <button type="button" @click="delrow(item, row.id)">X</button>
                </div>
                <div class="choose">
                  <button type="button" @click="addrow(item, item.id)">新增列</button>
                </div>
              </div>
              <div class="right">
                <div>欄</div>
                <div v-for="(column, index) in item.square.column" :key="column.id" class="choose">
                  <input type="checkbox">
                  <input type="text" class="choose_line" :placeholder="'選項' + (index + 1)" v-model="column.text">
                  <button type="button" @click="delcolumn(item, column.id)">X</button>
                </div>
                <div class="choose">
                  <button type="button" @click="addcolumn(item, item.id)">新增欄</button>
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
                  <input type="text" class="choose_line" :placeholder="'選項' + (index + 1)" v-model="row.text">
                  <button type="button" @click="delrow(item, row.id)">X</button>
                </div>
                <div class="choose">
                  <button type="button" @click="addrow(item, item.id)">新增列</button>
                </div>
              </div>
              <div class="right">
                <div>欄</div>
                <div v-for="(column, index) in item.square.column" :key="column.id" class="choose">
                  <input type="checkbox">
                  <input type="text" class="choose_line" :placeholder="'選項' + (index + 1)" v-model="column.text">
                  <button type="button" @click="delcolumn(item, column.id)">X</button>
                </div>
                <div class="choose">
                  <button type="button" @click="addcolumn(item, item.id)">新增欄</button>
                </div>
              </div>
            </div>
          </div>
          <!-- 第二行 第十種  日期 -->
          <div v-if="item.type === 10" class="questype-10 !block">
            <input type="date" class="calender">
          </div>
          <!-- 第二行 第十一種  時間 -->
          <div v-if="item.type === 11" class="questype-11 !block">
            <input type="time" hidden>
            <div class="clock">時間<img :src="time" alt=""></div>
          </div>
          <!-- 第三行 -->
          <div class="question-bottom">
            <div class="func">
              <img :src="copy" alt="">
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
        <button type="submit" class="bg-purple text-white py-[10px] px-[15px] rounded-lg drop-shadow-md hover:scale-105 fixed right-[250px] bottom-5" @click="submitData()">儲存表單</button>
      </form>
    </div>
  </section>
</template>

<style lang="scss" scoped>
#question {
    $grey: rgb(178, 176, 176);
    $font-grey: rgb(108, 105, 105);
    $grey-bac: rgb(104, 108, 113);
    $blue: rgb(237, 244, 253);
    $md-blue: rgb(39, 123, 233);

    .container {
        @apply max-w-[770px] m-auto relative mt-[20px];

        .side {
            @apply w-[49px] h-[253px] flex flex-col absolute top-0 -right-[70px] bg-white rounded-[10px] shadow tablet:fixed tablet:flex-row tablet:justify-around tablet:h-[60px] tablet:w-[98%] tablet:top-[calc(100%-60px)] tablet:left-0;

            img {
                @apply w-[22px];
            }

            .side-func {
                @apply flex justify-center items-center relative py-[10px] hover:bg-blue-light;

                &:hover span {
                    @apply block;
                }

                &:nth-of-type(1) {
                    @apply rounded-tl-[10px] rounded-tr-[10px];
                }

                &:nth-of-type(6) {
                    @apply rounded-bl-[10px] rounded-br-[10px];
                }

                span {
                    @apply hidden absolute w-auto whitespace-nowrap p-[6px] bg-gray-500 text-white text-xs rounded-[3px] top-[10px] left-[60px];
                }
            }
        }

        .form-title {
            @apply w-full rounded-[10px] border-t-[10px] border-l-[10px] border-l-purple border-t-purple pt-[22px] pb-[24px] bg-white;

            .form-input {
                @apply border-x-0 border-t-0 border-b-gray-400 w-[91%] font-semibold my-2 mx-[25px] focus:border-b-[3px] focus:border-b-purple focus:outline-none;
            }

            .form-title-input {
                @apply h-[45px] text-[32px];
            }

            .form-explain-input-2 {
                @apply h-[21px] text-[18px] text-grey;
            }
        }

        .question {
            @apply rounded-[10px] border-l-[10px] border-l-purple p-[24px] my-[12px] bg-white;
            .question-top {
                @apply flex flex-wrap justify-between items-center;

                // @media(max-width:435px){
                //     justify-content:initial;
                // }
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
                        @apply border-x-0 border-t-0 border-b-gray-400 w-full h-[56px] text-base font-semibold focus:bg-gray-50 focus:border-b-[3px] focus:border-b-purple focus:outline-none rounded-tl-[10px] rounded-tr-[10px];
                    }
                }

                .check {
                    @apply relative mt-[10px];

                    @media(max-width:435px) {
                        margin-left: 10px;
                    }

                    .check-box {
                        @apply flex justify-around items-center w-[209px] h-[49px] rounded-[10px] text-gray-500 font-semibold border border-grey;
                    }

                    .answer-type {
                        @apply w-[209px] max-h-[380px] border border-grey rounded-[10px] overflow-y-scroll;

                        ul {
                            @apply w-full border-x-0 border-t-0 bg-white border border-b-gray-400 px-[3px] py-[8px] m-0;

                            button {
                                @apply w-full flex h-[48px] p-[8px] font-normal hover:bg-blue;

                                img {
                                    @apply mr-[26px] w-[22px] h-[22px] inline-block;
                                }
                            }
                        }
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
                      @apply w-[80%] border-none h-[30px] text-[16px] font-medium hover:border-b hover:border-grey focus:border-b-[3px] focus:border-[#673ab7] focus:outline-none;
                    }

                    .choose_line2 {
                      @apply w-[100px] text-grey;
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
                      @apply w-[80%] border-none h-[30px] text-[16px] font-medium hover:border hover:border-grey focus:border-b-[3px] focus:border-[#673ab7] focus:outline-none;
                    }

                    .choose_line2 {
                      @apply w-[100px] text-grey;
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
                      @apply w-[80%] border-none h-[30px] text-[16px] font-medium hover:border hover:border-grey focus:border-b-[3px] focus:border-[#673ab7] focus:outline-none;
                    }

                    .choose_line2 {
                      @apply w-[100px] text-grey;
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
                    @apply border-x-0 border-t-0 border-b border-b-grey w-[200px] h-[40px] text-base text-grey font-semibold my-2 mx-[25px] focus:border-b-[3px] focus:border-b-purple outline-none;
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
                              @apply w-4/5 border-0 h-[40px] text-base font-medium hover:border-b hover:border-b-grey focus:border-x-0 focus:border-t-0 focus:border-b-[3px] focus:border-b-purple focus:outline-none;
                            }
                            .choose_line2 {
                              @apply w-[70px] text-grey;
                            }
                        }
                    }
                    .right {
                        #checkbox,
                        #checkbox2 {
                          @apply w-6 h-6 mr-[5px] pointer-events-none;
                        }
                    }
                }
            }

            .questype-10 {
                @apply pt-[20px] pb-[35px] hidden border-x-0 border-t-0 border-b border-b-grey;
                .calender {
                    @apply w-[35%] text-base font-semibold text-grey border-x-0 border-t-0 border-dotted border-b-grey;
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

                    @media(max-width:480px) {
                        display: none;
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
}</style>


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
import close from '/resources/images/close.svg';
import dots from '/resources/images/dots.png';
import check_box from '/resources/images/check_box.png';
import arrow_down from '/resources/images/arrow_down.png';
import del from '/resources/images/del.png';
import save from '/resources/images/save.svg';
import copy from '/resources/images/copy.png';
import { questionTypeOption } from '@/Composables/useQuestionType';
import { router } from '@inertiajs/vue3';

export default {
  components: {
  },
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
      close: close,
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
      save: save,
      copy: copy,
      maxId: 1,
      questionTypeOption,
      formData: this.response?.rt_data?.questionNaires?.map(questionnaire => {
        return {
          id: questionnaire.id,
          answer: '',
          manyOptions: [],
          time: {
            hour: '',
            minute: '',
            section: 'a.m.',
          },
          file: {
            name: '',
            path: '',
          },
        };
      }) ?? [],
      fileSize: 0,
      submitted: false,
    };
  },
  methods: {
    arrayData(min, max) {
      let loopResult = [];
      for (let i = min; i <= max; i++) {
        loopResult.push(i);
      }
      return loopResult;
    },
    submitData() {
      this.submitted = true;
      const { formData, response } = this;
      const formId = response.rt_data.responseForm[0].id;
      if (this.fileSize > 3145728) return Swal.fire('圖片檔案過大');
      router.visit(route('reply.store'), {
        method: 'post', data: { formData, formId }, preserveState: true,
      });
    },
    // 檔案上傳
    handleFileUpload(e, key) {
      this.formData[key].file.name = e.target.files[0];
    },
    // 刪除上傳的檔案
    handleFileDelete(e, key) {
      this.formData[key].file.name = '';
    },
    validateMinute(id) {
      if (this.formData[id].time.minute < 0) {
        this.formData[id].time.minute = 0;
      } else if (this.formData[id].time.minute > 59) {
        this.formData[id].time.minute = 59;
      }
    },
    validateHour(id) {
      if (this.formData[id].time.hour < 0) {
        this.formData[id].time.hour = 0;
      } else if (this.formData[id].time.hour > 12) {
        this.formData[id].time.hour = 12;
      }
    },
  },

};
</script>

<template>
  <section id="question">
    <form @submit.prevent="submitData()">
      <div class="container">
        <!-- 表單命名處 -->
        <div class="form-title">
          <!-- 表單名稱 -->
          <div class="form-input form-title-input">{{ response.rt_data.responseForm[0].qu_naires_title }} </div>
          <!-- 表單說明 -->
          <div class="form-input form-explain-input-2">{{ response.rt_data.responseForm[0].qu_naires_desc }}
          </div>
        </div>
        <div v-for="(item, key) in response.rt_data.questionNaires" :key="item.id" class="question">
          <!-- 問題框內圖片 -->
          <div class="p-5">
            <img v-if="item.image" :src="item.image" class="w-full aspect-[5/3] object-cover" alt="">
          </div>
          <!-- 簡答 -->
          <div v-if="item.type === 1" class="!block">
            <span class="text-[18px]">{{ item.title }}</span>
            <div class="questype-1">
              <input v-model="formData[key].answer" type="text" class="short" placeholder="簡答" :required="item.request">
            </div>
          </div>
          <!-- 詳答 -->
          <div v-if="item.type === 2" class="!block">
            <span class="text-[18px]">{{ item.title }}</span>
            <div class="questype-2">
              <input v-model="formData[key].answer" type="text" class="long" placeholder="詳答" :required="item.request">
            </div>
          </div>
          <!-- 選擇題 -->
          <div v-if="item.type === 3" class="!block">
            <span class="text-[18px]">{{ item.title }}</span>
            <div class="questype-3">
              <div v-for="(choose, innerkey) in item.options" :key="choose.id" class="option">
                <input v-model="formData[key].answer" type="radio" :name="'choice-questions' + key" id="choice-1"
                  :value="innerkey + 1" :required="item.request">
                <label for="choice-1">{{ choose.value }}</label>
              </div>
            </div>
          </div>
          <!-- 核取方塊 -->
          <div v-if="item.type === 4" class="!block">
            <span class="text-[18px]">{{ item.title }}</span>
            <div class="questype-4">
              <div v-for="(choose, innerkey) in item.options" :key="choose.id" class="option">
                <input v-model="formData[key].manyOptions" type="checkbox" class="focus:" :name="'checkbox-' + key"
                  :id="'checkbox-' + choose.id" :value="innerkey + 1"
                  :required="item.request && formData[key].manyOptions.length === 0">
                <label :for="'checkbox-' + choose.id">{{ choose.value }}</label>
              </div>
            </div>
          </div>
          <!-- 下拉式選單 -->
          <div v-if="item.type === 5" class="!block">
            <span class="text-[18px]">{{ item.title }}</span>
            <div class="questype-5">
              <label for="select"></label>
              <select v-model="formData[key].answer" name="select" id="select">
                <option v-for="choose in item.options" :key="choose.id" :value="choose.id" :required="item.request">{{
                  choose.value }}
                </option>
              </select>
            </div>
          </div>
          <!-- 檔案上傳 -->
          <div v-if="item.type === 6" class="!block">
            <span class="text-[18px]">{{ item.title }}</span>
            <div class="questype-6">
              <label v-if="!formData[key].file.name"
                class="border border-[gray] w-[50px] h-[50px] rounded-lg flex justify-center items-center text-[30px] cursor-pointer hover:border-grey-light hover:bg-grey-light">
                +
                <input type="file" class="hidden" accept=".csv,.xls,.docx,image/*"
                  @change="(e) => handleFileUpload(e, key)">
              </label>
              <div class="flex items-center">
                <div v-if="formData[key].file.name" class="flex items-center">
                  <div v-if="typeof formData[key].file.name === 'string'"
                    class="border p-2 rounded-l w-auto border-grey flex items-center gap-2">
                    <img :src="image" alt="">
                    <span class="truncate">{{ formData[key].file.name }}</span>
                  </div>
                  <div v-else class="border p-2 rounded-l w-auto border-grey flex items-center gap-2">
                    <img :src="image" alt="">
                    <span class="truncate">{{ formData[key].file.name.name }}</span>
                  </div>
                  <button type="button" v-if="formData[key].file.name"
                    class="w-[42px] h-[42px] rounded-r bg-white border-grey border-y border-r flex justify-center items-center"
                    @click="(e) => handleFileDelete(e, key)">
                    <img :src="close" alt="">
                  </button>
                </div>
              </div>
            </div>
          </div>
          <!-- 線性刻度 -->
          <div v-if="item.type === 7" class="!block">
            <span class="text-[18px] w-[120px] truncate">{{ item.title }}</span>
            <div class="questype-7">
              <span>{{ item.linear.minText }}</span>
              <div v-for="(i, index) in arrayData(parseInt(item.linear.min), parseInt(item.linear.max))" :key=index>
                <span>{{ i }}</span>
                <input v-model="formData[key].manyOptions" type="radio" :name="'linear-' + item.id" :id="'linear-' + i"
                  :value="i" :required="item.request">
              </div>
              <span class="w-[120px] truncate">{{ item.linear.maxText }}</span>
            </div>
          </div>
          <!-- 單選方格 -->
          <div v-if="item.type === 8" class="!block">
            <span class="text-[18px]">{{ item.title }}</span>
            <div class="questype-8">
              <table>
                <thead>
                  <tr>
                    <th></th>
                    <th v-for="choose in item.square.column" :key="choose.id">{{ choose.text }}</th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="(choose, innerkey) in item.square.row" :key="choose.id">
                    <th>{{ choose.text }}</th>
                    <td v-for="(choose, innerinnerkey) in item.square.column" :key="choose.id">
                      <input v-model="formData[key].manyOptions[innerkey]" type="radio" :name="'only-' + key + innerkey"
                        :value="'row' + (innerkey + 1) + 'col' + (innerinnerkey + 1)" :required="item.request">
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
          <!-- 核取方塊格 -->
          <div v-if="item.type === 9" class="!block">
            <span class="text-[18px]">{{ item.title }}</span>
            <div class="questype-9">
              <table>
                <thead>
                  <tr>
                    <th></th>
                    <th v-for="choose in item.square.column" :key="choose.id">{{ choose.text }}</th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="(choose, innerkey) in item.square.row" :key="choose.id">
                    <th>{{ choose.text }}</th>
                    <td v-for="(choose, innerinnerkey) in item.square.column" :key="choose.id">
                      <input v-model="formData[key].manyOptions" type="checkbox" :name="'many-' + innerkey"
                        :value="'row' + (innerkey + 1) + 'col' + (innerinnerkey + 1)"
                        :required="item.request && formData[key].manyOptions.length === 0">
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
          <!-- 日期 -->
          <div v-if="item.type === 10" class="!block">
            <span class="text-[18px]">{{ item.title }}</span>
            <div class="questype-10">
              <input v-model="formData[key].answer" type="date" :required="item.request">
            </div>
          </div>
          <!-- 時間 -->
          <div v-if="item.type === 11" class="!block">
            <span class="text-[18px]">{{ item.title }}</span>
            <div class="questype-11">
              <input type="number" v-model="formData[key].time.hour" :required="item.request" @input="validateHour(key)" min="0" max="12">
              <span>:</span>
              <input type="number" v-model="formData[key].time.minute" :required="item.request" @input="validateMinute(key)" min="0" max="59">
              <select name="" id="" v-model="formData[key].time.section">
                <option value="a.m.">上午</option>
                <option value="p.m.">下午</option>
              </select>
            </div>
          </div>
          <!-- 影片 -->
          <div v-if="item.type === 13" class="!block">
            <span class="text-[18px]">{{ item.title }}</span>
            <div class="p-5 flex justify-center">
              <iframe class="max-w-[600px] w-[90%] h-[400px]" :src="item.video" title="YouTube video player"
                frameborder="0" allowfullscreen></iframe>
            </div>
          </div>
        </div>
      </div>
      <button type="submit" :disabled="submitted"
        class="submit-btn">送出</button>
    </form>
  </section>
</template>

<style lang="scss" scoped>
#question {
  form {
    @apply flex justify-center items-center m-auto max-w-[920px] min-h-screen relative;
    .container {
    @apply max-w-[770px] m-auto relative mt-[20px];
    .form-title {
        @apply w-full rounded-[10px] border-t-[10px] border-l-[10px] border-l-purple border-t-purple pt-[22px] pb-[24px] bg-white;

        .form-input {
        @apply border-x-0 border-t-0 border-b-gray-400 w-[91%] font-semibold my-2 mx-[25px] focus:border-b-[3px] focus:border-b-purple focus:outline-none;
        }

        .form-title-input {
        @apply h-auto text-[32px] leading-9;
        }

        .form-explain-input-2 {
        @apply h-auto text-[18px] text-grey;
        }
    }

    .question {
        @apply rounded-[10px] drop-shadow-md border border-grey-light p-[24px] my-[12px] bg-white;

        .questype-1 {
        @apply pt-[20px] pb-[10px];

        .short {
            @apply w-[60%] text-[16px] font-semibold border-b-[2px] border-grey-middle border-0 focus:ring-0 focus:border-b-purple focus:border-b-[3px];
        }
        }

        .questype-2 {
        @apply pt-[20px] pb-[10px];

        .long {
            @apply w-[85%] text-[16px] font-semibold border-b-[2px] border-grey-middle border-0 focus:ring-0 focus:border-b-purple focus:border-b-[3px];
        }
        }

        .questype-3 {
        @apply w-full pt-[20px] flex flex-col;

        .option {
            @apply flex items-center mb-3;

            label {
            @apply ml-[10px];
            }
        }
        }

        .questype-4 {
        @apply w-full pt-[20px];

        .option {
            @apply flex items-center mb-3;

            label {
            @apply ml-[10px];
            }
        }
        }

        .questype-5 {
        @apply w-full py-[30px];

        #select {
            @apply w-[30%] h-[50px] border-green-middle rounded-md;
        }
        }

        .questype-6 {
        @apply w-full py-[10px];

        #file-upload-button {
            @apply bg-purple;
        }
        }

        .questype-7 {
        @apply w-full border-x-0 border-t-0 py-[30px] flex items-end justify-center gap-10;
        @media (max-width: 690px) {
            @apply flex-col items-start pl-5;
        }
        div input {
            @media (max-width: 690px) {
                @apply ml-[5px];
            }
            }
        }

        .questype-8,
        .questype-9 {
        @apply w-full;

        table {
            @apply w-full;

            tbody {
            @apply py-10;

            td {
                @apply text-center;
            }
            }
        }
        }

        .questype-10 {
        @apply pt-[20px] pb-[20px];

        input {
            @apply border-0 border-b-[2px] border-grey-middle focus:ring-0 focus:border-b-purple focus:border-b-[3px] focus:transition-all;
        }
        }

        .questype-11 {
        @apply pt-[20px] pb-[20px];

        input {
            @apply w-[60px] h-[30px] border-0 border-b-[2px] border-grey-middle focus:ring-0 focus:border-b-purple focus:border-b-[3px] focus:transition-all;
        }

        span {
            @apply mx-2;
        }

        select {
            @apply border-0 focus:ring-0;
        }
        }
    }
    }
    .submit-btn {
    @apply bg-purple text-white py-[10px] px-[10px] rounded-lg drop-shadow-md hover:scale-105 sticky top-[90%] truncate;
    @media(max-width:840px) {
        @apply fixed right-[5px];
    }
    }
  }
}
</style>


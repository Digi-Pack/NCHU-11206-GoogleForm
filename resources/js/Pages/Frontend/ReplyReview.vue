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
import close from '/resources/images/close.svg';
import time from '/resources/images/time.png';
import dots from '/resources/images/dots.png';
import check_box from '/resources/images/check_box.png';
import arrow_down from '/resources/images/arrow_down.png';
import del from '/resources/images/del.png';
import copy from '/resources/images/copy.png';
import { questionTypeOption } from '@/Composables/useQuestionType';
import { router } from '@inertiajs/vue3';
import Swal from 'sweetalert2';

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
      short_text: short_text,
      long_text: long_text,
      radio_button: radio_button,
      circle_down: circle_down,
      cloud_upload: cloud_upload,
      close: close,
      date: date,
      time: time,
      dots: dots,
      check_box: check_box,
      arrow_down: arrow_down,
      del: del,
      copy: copy,
      maxId: 1,
      questionTypeOption,
      formData: this.response?.rt_data?.lastAnswer?.map(answer => {
        return {
          id: answer.id,
          answer: answer.answer,
          manyOptions: answer.manyOptions,
          time: answer.time,
          file: answer.file,
        };
      }) ?? [],
      fileSize: 0,
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
      const { formData, response } = this;
      const formId = response.rt_data.responseForm[0].id;
      if (this.fileSize > 3145728) return Swal.fire('圖片檔案過大');
      // 驗證
      router.visit(route('reply.update'), {
        method: 'post', data: { formData, formId }, preserveState: true,
        onSuccess: ({ props }) => {
          if (props.flash.message.rt_code === 1) {
            Swal.fire({
              title: '已完成修改',
              showDenyButton: false,
              confirmButtonText: '確認',
              denyButtonText: '',
            }).then((result) => {
              if (result.isConfirmed) {
                router.visit(route('reply.final'), {
                  method: 'post', data: { formData, formId },
                });
              }
            });
          }
        },
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
          <!-- 簡答 -->
          <div>
            <img v-if="item.image" :src="item.image" class="w-[200px] aspect-[4/3] object-cover" alt="">
          </div>
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
                <option v-for="choose in item.options" :key="choose.id" :value="choose.id" :required="item.request" selected>{{
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
                  <div v-if="typeof formData[key].file.name === 'string'" class="border p-2 rounded-l w-auto border-grey flex items-center gap-2">
                    <img :src="image" alt="">
                    <span class="truncate">{{ formData[key].file.name }}</span>
                  </div>
                  <div v-else class="border p-2 rounded-l w-auto border-grey flex items-center gap-2">
                    <img :src="image" alt="">
                    <span class="truncate">{{ formData[key].file.name.name }}</span>
                  </div>
                  <button type="button" v-if="formData[key].file.name" class="w-[42px] h-[42px] rounded-r bg-white border-grey border-y border-r flex justify-center items-center" @click="(e) => handleFileDelete(e, key)">
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
                      <input v-model="formData[key].manyOptions" type="checkbox"
                        :name="'many-' + innerkey + '-' + innerinnerkey"
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
            <div class="p-5 flex justify-center">
              <iframe class="max-w-[600px] w-[90%] h-[400px]" :src="item.video" title="YouTube video player"
                frameborder="0" allowfullscreen></iframe>
            </div>
          </div>
        </div>
      </div>
      <button type="submit"
        class="submit-btn">完成修改</button>
    </form>
  </section>
</template>

<style lang="scss" scoped>
#question {
  @apply pl-[150px];
  @media(max-width:1050px) {
    @apply pl-0;
  }
  form {
    @apply flex justify-between items-center m-auto max-w-[920px] relative min-h-screen;
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
        .questype-8, .questype-9 {
          @apply w-full;
          table {
            @apply w-full table-fixed border-separate border-spacing-y-2;
            th {
              @apply truncate;
            }
            tbody {
              @apply py-10;
              tr {
                @apply bg-grey-light;
                th {
                  @apply truncate;
                }
                td {
                  @apply text-center py-4;
                }
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
      @apply bg-purple text-white py-[10px] px-[15px] rounded-lg drop-shadow-md hover:scale-105 sticky top-[92%] truncate;
      @media(max-width:1050px) {
        @apply fixed right-[5px];
      }
    }
  }
}
</style>


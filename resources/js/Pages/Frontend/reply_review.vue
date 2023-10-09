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
        };
      }) ?? [],
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
      // if (this.imageSize > 3145728) return Swal.fire('圖片檔案過大');
      // 驗證
      router.visit(route('reply.update'), {
        method: 'post', data: { formData, formId }, preserveState: true,
        onSuccess: ({ props }) => {
          if (props.flash.message.rt_code === 1) {
            Swal.fire({
              title: '已完成修改',
              showDenyButton: true,
              confirmButtonText: '回列表',
              denyButtonText: '再次修改',
            }).then((result) => {
              if (result.isConfirmed) {
                router.get(route('guide.index'));
              } else if (result.isDenied) {
                router.visit(route('reply.update'), {
                  method: 'post', data: { formData, formId }, preserveState: true });
              }
            });
          }
        },
      });
    },
  },
};
</script>

<template>
  <!-- {{ response }} -->
  <!-- {{ response }} -->
  <!-- {{ response.rt_data.responseForm[0] }} -->
  <!-- {{ response.rt_data.questionNaires }} -->
  <!-- {{ formData }} -->
  <!-- {{ formData[3].answer }} -->
  <section id="question">
    <form @submit.prevent="submitData()" class="flex justify-between items-center m-auto max-w-[920px] relative min-h-screen">
      <div class="container">
        <!-- 表單命名處 -->
        <div class="form-title">
          <!-- 表單名稱 -->
          <div class="form-input form-title-input">{{ response.rt_data.responseForm[0].qu_naires_title }} </div>
          <!-- 表單說明 -->
          <div class="form-input form-explain-input-2">{{ response.rt_data.responseForm[0].qu_naires_desc }} </div>
        </div>
        <div v-for="(item, key) in response.rt_data.questionNaires" :key="item.id" class="question">
          <!-- 簡答 -->
          <div>
            <img v-if="item.image" :src="item.image" class="w-[200px] aspect-[4/3] object-cover" alt="">
          </div>
          <div v-if="item.type === 1" class="!block">
            <span class="text-[18px]">{{ item.title }}</span>
            <div class="questype-1">
              <input v-model=" formData[key].answer " type="text" class="short" placeholder="簡答" :required="item.request">
            </div>
          </div>
          <!-- 詳答 -->
          <div v-if="item.type === 2" class="!block">
            <span class="text-[18px]">{{ item.title }}</span>
            <div class="questype-2">
              <input v-model=" formData[key].answer" type="text" class="long" placeholder="詳答" :required="item.request">
            </div>
          </div>
          <!-- 選擇題 -->
          <div v-if="item.type === 3" class="!block">
            <span class="text-[18px]">{{ item.title }}</span>
            <div class="questype-3">
              <div v-for="(choose, innerkey) in item.options" :key="choose.id" class="option">
                <input v-model=" formData[key].answer" type="radio" :name="'choice-questions' + key" id="choice-1" :value="innerkey + 1" :required="item.request">
                <label for="choice-1">{{ choose.value }}</label>
              </div>
            </div>
          </div>
          <!-- 核取方塊 -->
          <div v-if="item.type === 4" class="!block">
            <span class="text-[18px]">{{ item.title }}</span>
            <div class="questype-4">
              <div v-for="(choose, innerkey) in item.options" :key="choose.id" class="option">
                <input v-model="formData[key].manyOptions" type="checkbox" class="focus:" :name="'checkbox-' + key" :id="'checkbox-' + choose.id" :value="innerkey + 1" :required="item.request && formData[key].manyOptions.length === 0">
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
                <option v-for="choose in item.options" :key="choose.id" :value="choose.value" :required="item.request">{{ choose.value }}
                </option>
              </select>
            </div>
          </div>
          <!-- 檔案上傳 -->
          <div v-if="item.type === 6" class="!block">
            <span class="text-[18px]">檔案上傳</span>
            <div class="questype-6">
              <label for=""></label>
              <input type="file" name="" id="">
            </div>
          </div>
          <!-- 線性刻度 -->
          <div v-if="item.type === 7" class="!block">
            <span class="text-[18px]">{{ item.title }}</span>
            <div class="questype-7">
              <span>{{ item.linear.minText }}</span>
              <div v-for="(i, index) in arrayData(parseInt(item.linear.min), parseInt(item.linear.max))" :key=index>
                <label> {{ i }}
                </label>
                <input v-model="formData[key].manyOptions" type="radio" :name="'linear-' + item.id" :id="'linear-' + i" :value="i" :required="item.request">
              </div>
              <span class="">{{ item.linear.maxText }}</span>
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
                      <input v-model="formData[key].manyOptions[innerkey]" type="radio" :name="'only-' + key + innerkey" :value="'row' + (innerkey + 1) + 'col' + (innerinnerkey + 1)" :required="item.request">
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
                      <input v-model="formData[key].manyOptions" type="checkbox" :name="'many-' + innerkey + '-' + innerinnerkey" :value="'row' + (innerkey + 1) + 'col' + (innerinnerkey + 1)" :required="item.request && formData[key].manyOptions.length === 0">
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
              <input v-model=" formData[key].answer" type="date" :required="item.request">
            </div>

          </div>
          <!-- 時間 -->
          <div v-if="item.type === 11" class="!block">

            <span class="text-[18px]">{{ item.title }}</span>
            <div class="questype-11">
              <input type="text" v-model=" formData[key].time.hour" :required="item.request">
              <span>:</span>
              <input type="text" v-model=" formData[key].time.minute">
              <select name="" id="" v-model=" formData[key].time.section">
                <option value="a.m.">上午</option>
                <option value="p.m.">下午</option>
              </select>

            </div>
          </div>
        </div>
      </div>
      <button type="submit" class="bg-purple text-white flex self-start py-[10px] px-[15px] sticky top-[92%] rounded-lg drop-shadow-md hover:scale-105 truncate">完成修改</button>
    </form>
  </section>
</template>

<style lang="scss" scoped>
#question {
  @apply pl-[150px];
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
        @apply h-[34px] text-[18px] text-grey;
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
        .linear {
          @apply flex flex-col;

          label {
            @apply flex items-center justify-center mb-2;
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


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

export default {
  components: {
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
    };
  },
};
</script>

<template>
  <section id="question">
    <div class="container">
      <!-- 表單命名處 -->
      <div class="form-title">
        <!-- 表單名稱 -->
        <input type="text" value="未命名的表單" class="form-input form-title-input">
        <!-- 表單說明 -->
        <input type="text" value="表單說明" class="form-input form-explain-input-2">
      </div>
      <!-- 簡答 -->
      <div class="question">
        <span class="text-[18px]">未命名的問題</span>
        <div class="questype-1">
          <input type="text" class="short" placeholder="您的回答">
        </div>
      </div>
      <!-- 詳答 -->
      <div class="question">
        <span class="text-[18px]">詳答</span>
        <div class="questype-2">
          <input type="text" class="long" placeholder="您的回答">
        </div>
      </div>
      <!-- 選擇題 -->
      <div class="question">
        <span class="text-[18px]">選擇題</span>
        <div class="questype-3">
          <div class="option">
            <input type="radio" name="choice-questions" id="choice-1">
            <label for="choice-1">選項一</label>
          </div>
          <div class="option">
            <input type="radio" name="choice-questions" id="choice-2">
            <label for="choice-2">選項二</label>
          </div>
          <div class="option">
            <input type="radio" name="choice-questions" id="choice-3">
            <label for="choice-3">選項三</label>
          </div>
        </div>
      </div>
      <!-- 核取方塊 -->
      <div class="question">
        <span class="text-[18px]">核取方塊</span>
        <div class="questype-4">
          <div class="option">
            <input type="checkbox" class="focus:" name="checkbox-1" id="checkbox-1">
            <label for="checkbox-1">選項一</label>
          </div>
          <div class="option">
            <input type="checkbox" name="checkbox-2" id="checkbox-2">
            <label for="checkbox-2">選項二</label>
          </div>
          <div class="option">
            <input type="checkbox" name="checkbox-3" id="checkbox-3">
            <label for="checkbox-3">選項三</label>
          </div>
        </div>
      </div>
      <!-- 下拉式選單 -->
      <div class="question">
        <span class="text-[18px]">下拉式選單</span>
        <div class="questype-5">
          <label for="select"></label>
          <select name="select" id="select">
            <option value="選項一">選項一</option>
            <option value="選項二">選項二</option>
            <option value="選項三">選項三</option>
          </select>
        </div>
      </div>
      <!-- 檔案上傳 -->
      <div class="question">
        <span class="text-[18px]">檔案上傳</span>
        <div class="questype-6">
          <label for=""></label>
          <input type="file" name="" id="">
        </div>
      </div>
      <!-- 線性刻度 -->
      <div class="question">
        <span class="text-[18px]">線性刻度</span>
        <div class="questype-7">
          <span>標籤</span>
          <div class="linear">
            <label for="linear-1">1</label>
            <input type="radio" name="linear" id="linear-1">
          </div>
          <div class="linear">
            <label for="linear-2">2</label>
            <input type="radio" name="linear" id="linear-2">
          </div>
          <div class="linear">
            <label for="linear-3">3</label>
            <input type="radio" name="linear" id="linear-3">
          </div>
          <div class="linear">
            <label for="linear-4">4</label>
            <input type="radio" name="linear" id="linear-4">
          </div>
          <div class="linear">
            <label for="linear-5">5</label>
            <input type="radio" name="linear" id="linear-5">
          </div>
          <span class="">標籤</span>
        </div>
      </div>
      <!-- 單選方格 -->
      <div class="question">
        <span class="text-[18px]">單選方格</span>
        <div class="questype-8">
          <table>
            <thead>
              <tr>
                <th></th>
                <th>第一欄</th>
                <th>第二欄</th>
                <th>第三欄</th>
                <th>第四欄</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <th>第一列</th>
                <td><input type="radio" name="row-1"></td>
                <td><input type="radio" name="row-1"></td>
                <td><input type="radio" name="row-1"></td>
                <td><input type="radio" name="row-1"></td>
              </tr>
              <tr>
                <th>第二列</th>
                <td><input type="radio" name="row-2"></td>
                <td><input type="radio" name="row-2"></td>
                <td><input type="radio" name="row-2"></td>
                <td><input type="radio" name="row-2"></td>
              </tr>
              <tr>
                <th>第三列</th>
                <td><input type="radio" name="row-3"></td>
                <td><input type="radio" name="row-3"></td>
                <td><input type="radio" name="row-3"></td>
                <td><input type="radio" name="row-3"></td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
      <!-- 核取方塊格 -->
      <div class="question">
        <span class="text-[18px]">核取方塊格</span>
        <div class="questype-9">
          <table>
            <thead>
              <tr>
                <th></th>
                <th>第一欄</th>
                <th>第二欄</th>
                <th>第三欄</th>
                <th>第四欄</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <th>第一列</th>
                <td><input type="checkbox" name="row-1"></td>
                <td><input type="checkbox" name="row-1"></td>
                <td><input type="checkbox" name="row-1"></td>
                <td><input type="checkbox" name="row-1"></td>
              </tr>
              <tr>
                <th>第二列</th>
                <td><input type="checkbox" name="row-2"></td>
                <td><input type="checkbox" name="row-2"></td>
                <td><input type="checkbox" name="row-2"></td>
                <td><input type="checkbox" name="row-2"></td>
              </tr>
              <tr>
                <th>第三列</th>
                <td><input type="checkbox" name="row-3"></td>
                <td><input type="checkbox" name="row-3"></td>
                <td><input type="checkbox" name="row-3"></td>
                <td><input type="checkbox" name="row-3"></td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
      <!-- 日期 -->
      <div class="question">
        <span class="text-[18px]">日期</span>
        <div class="questype-10">
          <input type="date">
        </div>
      </div>
      <!-- 時間 -->
      <div class="question">
        <span class="text-[18px]">時間</span>
        <div class="questype-11">
          <input type="text">
          <span>:</span>
          <input type="text">
          <select name="" id="">
            <option value="a.m.">上午</option>
            <option value="p.m.">下午</option>
          </select>
        </div>
      </div>
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
            @apply rounded-[10px] drop-shadow-md border border-grey-light p-[24px] my-[12px] bg-white;

            img {
                @apply w-[22px];
            }
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
                .linear {
                  @apply flex flex-col;
                  label {
                    @apply flex items-center justify-center mb-2;
                  }
                }
            }

            .questype-8, .questype-9 {
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
                  @apply w-[30px] h-[30px] border-0 border-b-[2px] border-grey-middle focus:ring-0 focus:border-b-purple focus:border-b-[3px] focus:transition-all;
                }
                span {
                  @apply mx-2;
                }
                select {
                  @apply border-0 focus:ring-0 ;
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
}
</style>


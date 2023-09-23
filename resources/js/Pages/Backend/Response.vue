<script>
import excel from '/resources/images/excel.png';
import dot from '/resources/images/dot.png';
import download from '/resources/images/download.png';
import print from '/resources/images/print.png';
import del from '/resources/images/del.png';
import check from '/resources/images/check.png';
import linkoff from '/resources/images/link_off.png';

export default {
  data() {
    return {
      excel: excel,
      dot: dot,
      download: download,
      print: print,
      del: del,
      check: check,
      linkoff: linkoff,
    };
  },
};
</script>

<template>
  <section id="response">
    <div class="all">
      <div class="response-head">
        <div class="head-top">
          <h2>0則回應</h2>
          <div class="func">
            <div class="excel-link">
              <a class="to-excel" href="">
                <img class="excel" :src="excel" alt="">
                <span>連結至試算表</span>
                <span class="directions">將回覆傳送至試算表</span>
              </a>
            </div>
            <div>
              <input type="checkbox" id="dot-box-switch">
              <label for="dot-box-switch" class="menu">
                <img :src="dot" class="dot" alt="">
              </label>
              <div class="dot-box-all">
                <li>
                  <img :src="check" alt="">
                  <span class="text">有新回應時透過電子郵件通知我</span>
                </li>
                <li>
                  <span class="text pl-[40px]">選取回應目標位置</span>
                </li>
                <li>
                  <img :src="linkoff" alt="">
                  <span class="text">取消連結表單</span>
                </li>
                <li>
                  <img :src="download" alt="">
                  <span class="text">下載回應(.csv)</span>
                </li>
                <li>
                  <img :src="print" alt="">
                  <span class="text">列印所有回應</span>
                </li>
                <li>
                  <img :src="del" alt="">
                  <span class="text">刪除所有回應</span>
                </li>
              </div>
            </div>
          </div>
        </div>
        <div class="head-middle">
          <span>接受回應</span>
          <div class="btn">
            <div class="button-bar"></div>
            <div class="button-circle"></div>
          </div>
        </div>
      </div>
      <div class="response-body">
        <span>待回應</span>
      </div>
    </div>
  </section>
</template>

<style lang="scss" scoped>
#response {
    .response-head {
        @apply m-auto max-w-[768px] bg-[white] border my-[15px] rounded-[10px] border-gray-200;;

        .head-top {
            @apply pt-[16px] pr-[8px] ps-[24px] flex justify-between items-center;

            .func {
                @apply flex items-center;

                .excel-link {
                    @apply relative;

                    .to-excel {
                        @apply py-[10px] px-[24px] text-[20px] flex;

                        .excel {
                            @apply w-[25px] h-[25px] mr-[10px] leading-[25px];
                        }

                        .directions {
                            @apply hidden absolute top-[36px] left-[12px] text-white text-[14px] rounded-[3px] p-[8px] cursor-none hover:rounded-[10px] hover:block;
                        }
                    }
                }

                .dot {
                    @apply relative w-[55px] h-[55px] p-[16px] text-center cursor-pointer hover:bg-gray-100 rounded-[50%];
                }

                .dot-box-all {
                    @apply absolute top-[40px] z-[9] bg-white rounded-[10px] py-[10px] w-auto h-[200px] overflow-auto shadow-[0_2px_1px_0_rgba(0,0,0,0.3)] hidden;

                        &::-webkit-scrollbar {
                            width: 1em;
                        };

                        &::-webkit-scrollbar-thumb {
                            background-color: rgb(180, 180, 180);
                            border: 1px solid white;
                        };

                    li {
                        @apply list-none leading-[25px] hover:bg-[#e6e6e6] flex py-[10px];

                        img {
                            @apply ml-[15px] w-[25px];
                        }
                        .text {
                            @apply pr-[10px] ml-[20px];
                        }
                    }
                }
                #dot-box-switch:checked~.dot-box-all {
                    @apply block;
                }
            }
        }

        .head-middle {
            @apply p-[24px] flex justify-end items-center;

            span {
                @apply mr-[20px] text-[#686868];
            }
            .btn {
                @apply relative;
                .button-bar {
                    @apply w-[45px] h-[18px] bg-[#e1d8f1] rounded-[25px] mt-[3px];
                }
                .button-circle {
                    @apply absolute mt-[2px] w-[25px] h-[25px] bg-[#673ab7] rounded-[50%] bottom-0 translate-y-1 shadow-[0_2px_3px_0_rgba(0,0,0,0.4)] hover:shadow-[0_0_0_10px_rgba(234,247,255,0.4)];
                }
            }
        }
        #dot-box-switch {
            @apply hidden;
        }
    }

    .response-body {
        @apply m-auto max-w-[768px] flex min-h-[80px] justify-center items-center bg-white border rounded-[10px] border-gray-200;
            span {
                @apply text-[#686868];
            }
        }
                // @media (max-width:480px) {
                //     .to-excel {
                //         display: none;
}

</style>


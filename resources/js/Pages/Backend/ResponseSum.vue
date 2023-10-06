<script>
import excel from '/resources/images/excel.png';
import dot from '/resources/images/dot.png';
import download from '/resources/images/download.png';
import print from '/resources/images/print.png';
import del from '/resources/images/del.png';
import check from '/resources/images/check.png';
import linkoff from '/resources/images/link_off.png';
import Echarts from '@/Components/Echarts.vue';

export default {
  components: {
    Echarts,
  },
  props:
  {
    response: Object,
  },
  data() {
    return {
      excel: excel,
      dot: dot,
      download: download,
      print: print,
      del: del,
      check: check,
      linkoff: linkoff,
      //   loaded: false,
      data: this.response.rt_data,
      //   options: {},
    };
  },
  methods: {
    currentUrl(urlName = '') {
      if (urlName === '') return;
      return route().current(urlName);
    },
  },
};
</script>

<template>
  {{ response.rt_data }}
  <section id="response-sum" class="pt-[10px]">
    <div class="all">
      <div class="response-head bg-white">
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
          <div class="switch">
            <label>
              <span>接受回應</span>
              <input type="checkbox" name="" id="" class="checkbox">
              <div class="btn-box">
                <span class="btn"></span>
              </div>
            </label>
          </div>
        </div>
        <div class="head-fotter">
          <NavLink class="btn" :href="route('edit.index')" :active="currentUrl('edit.index')">
            摘要
          </NavLink>
          <NavLink class="btn" :href="route('nav2')" :active="currentUrl('nav2')">
            問題
          </NavLink>
          <NavLink class="btn" :href="route('dashboard')" :active="currentUrl('dashboard')">
            個別
          </NavLink>
        </div>
      </div>
      <div class="response-body bg-white">
        <div class="responser">
          <div class="title">哪些人已回應?</div>
          <div class="email">
            <span>電子郵件</span>
            <div class="email-address">user@gmail.com</div>
          </div>
        </div>
      </div>
      <Echarts :data="data" />
    </div>
  </section>
</template>

<style lang="scss" scoped>
#response-sum {
    @apply h-screen mt-[20px] pb-[20px];
.all {
    @apply m-auto max-w-[770px] relative z-[2];
    .response-head {
        @apply my-[15px] rounded-[10px] border border-gray-200;

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
                    @apply absolute top-[40px] z-[9] bg-white rounded-[10px] py-[10px] w-[300px] h-[200px] overflow-auto shadow-[0_2px_1px_0_rgba(0,0,0,0.3)] hidden;

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
                            @apply ml-[15px] w-[25px] h-[25px];
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
            .switch {
                @apply w-[150px];
                label {
                  @apply w-full flex justify-between items-center;
                }
                span {
                    @apply mr-0;
                }
                .btn-box {
                    @apply inline-block align-middle w-[40px] h-[20px] rounded-[100px] bg-grey-middle shadow-inner;
                }
                .btn-box .btn {
                    @apply inline-block -translate-y-1 drop-shadow-lg w-[25px] h-[25px] rounded-[50%] bg-[#673ab7] shadow-sm;
                }
                .checkbox {
                    @apply absolute opacity-0;
                }
                .checkbox:checked + .btn-box {
                    @apply bg-purple-light;
                }
                .checkbox:checked + .btn-box .btn {
                    @apply ml-[20px];
                }
            }
        }
        .head-fotter {
            @apply flex justify-around h-[40px];
            .btn {
              @apply p-[10px] text-[16px] rounded-none focus:bg-purple-light;
            }
        }
        #dot-box-switch {
            @apply hidden;
        }
    }

    .response-body {
        @apply flex min-h-[80px] justify-start items-center border rounded-[10px] border-gray-200;
            .responser {
                @apply w-full;
                .title {
                    @apply w-full text-[24px] font-semibold p-5 border-b;
                }
                .email {
                    @apply p-5;
                    span {
                        @apply text-lg font-semibold p-3;
                    }
                    .email-address {
                        @apply text-base py-3 pl-3 bg-gray-50 rounded-md;
                    }
                }
            }
        }
                // @media (max-width:480px) {
                //     .to-excel {
                //         display: none;
    }
}

</style>


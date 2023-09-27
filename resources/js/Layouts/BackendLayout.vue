<script>
import sendLinkModal from '@/Components/Modal/SendLinkModal.vue';
import palette from '/images/palette.svg';
import close from '/images/close.svg';
import image from '/images/image.svg';
import add from '/images/add.svg';
import visibility from '/images/visibility.svg';
import more_vert from '/images/more_vert.svg';
import content_copy from '/images/content_copy.svg';
import del from '/images/del.svg';
import link from '/images/link.svg';
import print from '/images/print.svg';
import group_add from '/images/group_add.svg';
import logo from '/images/logo.png';

export default {
  components: {
    sendLinkModal,
  },
  data() {
    return {
      images: {
        palette,
        close,
        image,
        add,
        visibility,
        more_vert,
        content_copy,
        del,
        link,
        print,
        group_add,
        logo,
      },
      show: false,
    };
  },
  methods: {
    /**
     * 判斷現在是否在urlName的路由
     * @param {String} urlName 路由名稱
     */
    currentUrl(urlName = '') {
      if (urlName === '') return;
      return route().current(urlName);
    },
    open() {
      this.show = !this.show;
    },
  },
};
</script>

<template>
  <section id="frontend-layout">
    <header id="header">
      <nav>
        <div class="container">
          <div class="top h-[60%] bg-white flex justify-between p-[10px]">
            <div class="topL flex justify-start items-center">
              <div class="square logo"><img :src="images.logo" width="25" alt=""></div>
              <span class="title">未命名表單</span>
            </div>
            <div class="topR">
              <input type="checkbox" id="ham-menu-switch-3" class="hidden">
              <label for="ham-menu-switch-3" class="ham-menu">
                <div class="paletteB"><img :src="images.palette" width="25" height="25" alt=""></div>
              </label>
              <div class="topic">
                <div class="topic-head">
                  <div class="top-text">
                    <img class="palette" :src="images.palette" alt="">
                    <span>主題</span>
                  </div>
                  <img class="close" :src="images.close" alt="">
                </div>
                <div class="topic-body">
                  <div class="font-style">
                    <h4>文字樣式</h4>
                    <div class="select-region">
                      <div class="region-title">頁首</div>
                      <select name="" id="font-family" value="Roboto">
                        <option value="">更多字型</option>
                        <option value="">近期</option>
                        <option value="">微軟正黑體</option>
                        <option value="">Arial</option>
                        <option value="">Comic Sans MS</option>
                        <option value="">Courier New</option>
                        <option value="">Georgia</option>
                        <option value="">Impact</option>
                        <option value="">Times New Roman</option>
                        <option value="">Trebuchet MS</option>
                        <option value="">Verdana</option>
                        <option value="">微軟正黑體</option>
                        <option value="">新細明體</option>
                        <option value="">新細明體-ExtB</option>
                      </select>
                      <select name="" id="font-size">
                        <option value="">18</option>
                        <option value="">19</option>
                        <option value="">20</option>
                        <option value="">21</option>
                        <option value="">22</option>
                        <option value="">23</option>
                        <option value="">24</option>
                      </select>
                    </div>

                    <div class="select-region">
                      <div class="region-title">問題</div>
                      <select name="" id="font-family" value="Roboto">
                        <option value="">更多字型</option>
                        <option value="">近期</option>
                        <option value="">微軟正黑體</option>
                        <option value="">Arial</option>
                        <option value="">Comic Sans MS</option>
                        <option value="">Courier New</option>
                        <option value="">Georgia</option>
                        <option value="">Impact</option>
                        <option value="">Times New Roman</option>
                        <option value="">Trebuchet MS</option>
                        <option value="">Verdana</option>
                        <option value="">微軟正黑體</option>
                        <option value="">新細明體</option>
                        <option value="">新細明體-ExtB</option>
                      </select>
                      <select name="" id="font-size">
                        <option value="">12</option>
                        <option value="">13</option>
                        <option value="">14</option>
                        <option value="">15</option>
                        <option value="">16</option>
                        <option value="">17</option>
                        <option value="">18</option>
                      </select>
                    </div>

                    <div class="select-region">
                      <div class="region-title">文字</div>
                      <select name="" id="font-family" value="Roboto">
                        <option value="">更多字型</option>
                        <option value="">近期</option>
                        <option value="">微軟正黑體</option>
                        <option value="">Arial</option>
                        <option value="">Comic Sans MS</option>
                        <option value="">Courier New</option>
                        <option value="">Georgia</option>
                        <option value="">Impact</option>
                        <option value="">Times New Roman</option>
                        <option value="">Trebuchet MS</option>
                        <option value="">Verdana</option>
                        <option value="">微軟正黑體</option>
                        <option value="">新細明體</option>
                        <option value="">新細明體-ExtB</option>
                      </select>
                      <select name="" id="font-size">
                        <option value="">9</option>
                        <option value="">10</option>
                        <option value="">11</option>
                        <option value="">12</option>
                      </select>
                    </div>
                  </div>

                  <div class="page-top mb-[20px]">
                    <div class="text-[18px] font-semibold mb-[10px]">頁首</div>
                    <label for="image">
                      <div class="choice-image">
                        <img :src="images.image" alt="">
                        <input type="file" name="" id="image" hidden>
                        <span>選擇圖片</span>
                      </div>
                    </label>
                  </div>
                  <div class="page-color mb-[20px]">
                    <div class="text-[18px] font-semibold mb-[10px]">顏色</div>
                    <div class="colorbox-all">
                      <div class="col">
                        <div class="colorbox bg-[#db4437]"><i class="fa-sharp fa-solid fa-check check"></i></div>
                        <div class="colorbox bg-[#673ab7]"><i class="fa-sharp fa-solid fa-check check"></i></div>
                        <div class="colorbox bg-[#3f51b5]"><i class="fa-sharp fa-solid fa-check check"></i></div>
                        <div class="colorbox bg-[#4285f4]"><i class="fa-sharp fa-solid fa-check check"></i></div>
                        <div class="colorbox bg-[#03a9f4]"><i class="fa-sharp fa-solid fa-check check"></i></div>
                        <div class="colorbox bg-[#00bcd4]"><i class="fa-sharp fa-solid fa-check check"></i></div>
                      </div>
                      <div class="col">
                        <div class="colorbox bg-[#ff5722]"><i class="fa-sharp fa-solid fa-check check"></i></div>
                        <div class="colorbox bg-[#ff9800]"><i class="fa-sharp fa-solid fa-check check"></i></div>
                        <div class="colorbox bg-[#009688]"><i class="fa-sharp fa-solid fa-check check"></i></div>
                        <div class="colorbox bg-[#4caf50]"><i class="fa-sharp fa-solid fa-check check"></i></div>
                        <div class="colorbox bg-[#607d8b]"><i class="fa-sharp fa-solid fa-check check"></i></div>
                        <div class="colorbox bg-[#9e9e9e]"><i class="fa-sharp fa-solid fa-check check"></i></div>
                      </div>
                      <div class="col">
                        <div class="colorbox bg-[#eeeeee]"><img class="add" :src="images.add"
                          alt=""></div>
                      </div>
                    </div>
                  </div>

                  <div class="page-background-color">
                    <div class="text-[18px] font-semibold mb-[10px]">背景</div>
                    <div class="col">
                      <div class="colorbox">
                        <i class="fa-sharp fa-solid fa-check check"></i>
                      </div>
                      <div class="colorbox">
                        <i class="fa-sharp fa-solid fa-check check"></i>
                      </div>
                      <div class="colorbox">
                        <i class="fa-sharp fa-solid fa-check check"></i>
                      </div>
                      <div class="colorbox border bg-[#f6f6f6]">
                        <i class="fa-sharp fa-solid fa-check check"></i>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <button type="button" class="eye"><img :src="images.visibility" width="25" height="25" alt=""></button>
              <button type="button" class="sent" @click="open()">傳送</button>
              <SendLinkModal v-if="show">
              </SendLinkModal>
              <input type="checkbox" id="ham-menu-switch" class="hidden">
              <label for="ham-menu-switch" class="ham-menu">
                <div class="downMenu">
                  <img :src="images.more_vert" width="25" height="25" alt="">
                </div>
              </label>
              <div id="menu">
                <div class="option"><img :src="images.content_copy" alt=""><span>建立副本</span></div>
                <div class="option"><img :src="images.del" alt=""><span>移至垃圾桶</span></div>
                <div class="option"><img :src="images.link" alt=""><span>取得預先填入的連結</span></div>
                <div class="option"><img :src="images.print" alt=""><span>列印</span></div>
                <div class="option"><img :src="images.group_add" alt=""><span>新增協作者</span></div>
              </div>
              <input type="checkbox" id="ham-menu-switch-2" class="hidden">
              <label for="ham-menu-switch-2" class="ham-menu">
                <div class="account"></div>
              </label>
              <div id="account-menu">
                <div class="google">
                  <div class="option">asd783738777@gmail.com</div>
                  <div class="photo"></div>
                  <div class="hello">shane，你好!</div>
                  <div class="manage">管理你的 Google 帳戶</div>
                  <div class="advice">建議採取的行動</div>
                  <div class="acc">
                    <div class="add">新增帳戶</div>
                    <div class="log-out">登出</div>
                  </div>
                  <div class="footer">
                    <span>隱私權政策</span>
                    <div class="dot"></div>
                    <span>服務條款</span>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="down">
            <NavLink class="btn" :href="route('nav')" :active="currentUrl('nav')">
              問題
            </NavLink>
            <NavLink class="btn" :href="route('nav2')" :active="currentUrl('nav2')">
              回覆
            </NavLink>
            <NavLink class="btn" :href="route('dashboard')" :active="currentUrl('dashboard')">
              設定
            </NavLink>
          </div>
        </div>
      </nav>
    </header>
    <main id="main">
      <slot />
    </main>
  </section>
</template>

<style lang="scss" scoped>
#frontend-layout {
  @apply w-full min-h-screen;
}

#main {
  @apply h-[calc(100dvh-107px)];
}

nav {
    .container {
      @apply flex h-[107px] flex-col justify-between bg-[#ededed] relative;
        .top {
            .topL {
                .logo {
                    @apply mx-[10px];
                }
                .title {
                  @apply text-[#202124] text-[18px] font-medium;
                }
            }
            .topR {
                @apply flex justify-between items-center;
                button {
                  @apply flex w-[45px] h-[45px] justify-center items-center mx-[5px];
                }
                .paletteB {
                  @apply flex w-[45px] h-[45px] cursor-pointer justify-center items-center me-[5px] hover:bg-[#ededed] rounded-[50%];
                }

                .topic {
                  @apply shadow-lg w-[380px] absolute right-0 top-[107px] bg-white overflow-y-scroll hidden;
                  .topic-head {
                  @apply px-[20px] w-[350px] flex justify-between drop-shadow-sm;
                    .top-text {
                      @apply py-[15px] flex items-center;
                      .palette {
                        @apply w-[24px] me-[10px];
                      }
                      span {
                        @apply text-[22px] font-normal leading-[24px];
                      }
                    }
                    .close {
                      @apply p-[15px] hover:rounded-full hover:bg-[#e5e5e5];
                    }
                  }
                  .topic-body {
                    @apply px-[20px] py-[10px] h-[calc(100vh-161px)];
                    .select-region {
                      @apply mb-[20px];
                      .region-title {
                        @apply text-[18px] font-semibold mb-[10px];
                      }
                      select {
                        @apply h-[50px] rounded-[5px] bg-[#ffffff];
                      }
                      #font-family {
                        @apply w-[200px] me-[8px];
                      }
                      #font-size {
                        @apply w-[80px];
                      }
                    }
                    .page-top {
                      .choice-image {
                        @apply w-[150px] flex justify-center border border-[#cbcbcb] rounded-[5px] py-[10px] cursor-pointer;
                        img {
                          @apply me-[10px];
                        }
                        span {
                          @apply text-[20px] font-semibold text-[#4d92ed];
                        }
                      }
                    }
                    .col {
                      @apply flex mb-[10px];
                      .colorbox {
                        @apply flex w-[30px] h-[30px] rounded-full me-[10px] justify-center items-center hover:drop-shadow-sm hover:scale-110 cursor-pointer;
                        .check {
                          @apply py-[7px] px-[4px] hidden;
                        }
                        .add {
                          @apply w-[24px];
                        }
                      }
                    }
                  }
                }
                .eye {
                  @apply mt-[5px] w-[45px] h-[45px] flex justify-center items-center mx-[10px] pb-[4px] hover:bg-[#ededed] rounded-[50%];
                }
                #ham-menu-switch-3:checked~.topic {
                    @apply block;
                }
                .sent {
                  @apply w-[76.5px] h-[36px] rounded-[5px] text-white bg-purple flex justify-center items-center;
                }
                #menu {
                  @apply w-[256px] bg-white border border-[gainsboro] rounded-[2px] mt-[5px] hidden shadow-lg absolute top-[50px] right-[50px];
                }
                .option {
                  @apply w-[230px] my-[12.5px] ps-[10px] leading-[30px] text-[#505050] flex font-bold items-center;
                    span {
                        @apply ms-[10px];
                    }
                }
                #ham-menu-switch:checked~#menu {
                    @apply block;
                }
                .downMenu {
                  @apply w-[45px] h-[45px] cursor-pointer flex justify-center items-center me-[5px] hover:bg-[#ededed] rounded-[50%];
                }
                .account {
                  @apply w-[30px] h-[30px] bg-purple rounded-[50%];
                }
                #account-menu {
                  @apply w-[400px] h-[400px] bg-[aliceblue] border border-[gainsboro] p-[5px] rounded-[30px] mt-[5px] hidden shadow-lg absolute top-[80px] right-[30px] z-[1];
                    .google {
                      @apply w-[100%] h-[100%] flex-col flex justify-between items-center;
                        .photo {
                          @apply w-[100px] h-[100px] rounded-[50%] bg-purple;
                        }
                        .hello {
                          @apply w-[80%] h-[30px] flex justify-center items-center;
                        }
                        .manage {
                          @apply w-[50%] h-[30px] flex justify-center items-center border border-black rounded-[30px] text-[#0756ff] text-[14px];
                        }
                        .advice {
                          @apply w-[80%] h-[50px] border border-black flex justify-center items-center rounded-[30px] bg-[#ededed];
                        }
                        .acc {
                          @apply w-[80%] h-[50px] flex flex-row justify-between;
                            .add {
                              @apply w-[49.5%] h-[50px] border border-black rounded-l-[30px] flex justify-center items-center bg-[#ededed]
                            }
                            .log-out {
                              @apply w-[49.5%] h-[50px] border border-black rounded-r-[30px] flex justify-center items-center bg-[#ededed]
                            }
                        }
                        .footer {
                          @apply w-[50%] h-auto flex flex-row justify-center items-center;
                            .dot {
                              @apply w-[5px] h-[5px] rounded-[50%] bg-black ms-[10px] me-[3px];
                            }
                        }
                    }
                }
                #ham-menu-switch-2:checked~#account-menu {
                    @apply block;
                }
            }
        }
        .down {
          @apply h-[40%] bg-white flex justify-center items-end border-b-2;
            .btn {
              @apply p-[10px] text-[16px] rounded-none;
            }
        }
    }
}

</style>

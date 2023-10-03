<script>
import CopyDocument from '@/Components/Modal/CopyDocument.vue';
import TrashCanModal from '@/Components/Modal/TrashCanModal.vue';
import AddCollaborator from '@/Components/Modal/AddCollaborator.vue';
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
import user from '/images/user.svg';
import account from '/images/account-circle.svg';
import { colorType } from '@/Composables/useBgColor';

export default {
  components: {
    CopyDocument,
    TrashCanModal,
    AddCollaborator,
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
        user,
        account,
      },
      show1: false,
      show2: false,
      show4: false,
      showTopic: false,
      bgColor: 'bg-indigo-light',
      coFormId: route()?.params?.id ?? '0',
    };
  },
  mounted() {
    // console.log(this.testId);
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
    open(num) {
      this['show' + num] = !this['show' + num];
    },
    changeColor(newColor) {
      console.log(colorType);
      let myNewColor = `bg-${newColor}`;
      this.bgColor = myNewColor;
    },
    myStyle() {
      return this.bgColor;
    },
    topicOpen() {
      this.showTopic = !this.showTopic;
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
              <Link :href="route('guide.index')">
                <div class="square logo">
                  <img :src="images.logo" width="25" alt="">
                </div>
              </Link>
              <span class="title">未命名表單</span>
            </div>
            <div class="topR">
              <button type="button" class="paletteB" @click="topicOpen()"><img :src="images.palette" width="25" height="25" alt=""></button>
              <div v-if="showTopic" class="topic z-50">
                <div class="topic-head">
                  <div class="top-text">
                    <img class="palette" :src="images.palette" alt="">
                    <span>主題</span>
                  </div>
                  <button type="button" class="close" @click="topicOpen()"><img :src="images.close" alt=""></button>
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
                        <button type="button" class="colorbox bg-red" @click="changeColor('red')"></button>
                        <button type="button" class="colorbox bg-purple" @click="changeColor('purple')"></button>
                        <button type="button" class="colorbox bg-indigo" @click="changeColor('indigo')"></button>
                        <button type="button" class="colorbox bg-blue" @click="changeColor('blue')"></button>
                        <button type="button" class="colorbox bg-light-blue" @click="changeColor('light-blue')"></button>
                        <button type="button" class="colorbox bg-cyan-blue" @click="changeColor('cyan-blue')"></button>
                      </div>
                      <div class="col">
                        <button type="button" class="colorbox bg-orange-red" @click="changeColor('orange-red')"></button>
                        <button type="button" class="colorbox bg-orange" @click="changeColor('orange')"></button>
                        <button type="button" class="colorbox bg-blue-green" @click="changeColor('blue-green')"></button>
                        <button type="button" class="colorbox bg-green" @click="changeColor('green')"></button>
                        <button type="button" class="colorbox bg-blue-gray" @click="changeColor('blue-gray')"></button>
                        <button type="button" class="colorbox bg-grey" @click="changeColor('grey')"></button>
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
                      <div class="colorbox"></div>
                      <div class="colorbox"></div>
                      <div class="colorbox"></div>
                      <div class="colorbox border bg-[#f6f6f6]"></div>
                    </div>
                  </div>
                </div>
              </div>
              <Link :href="route('reply.index', 8)">
                <button type="button" class="eye">
                  <img :src="images.visibility" width="25" height="25" alt="">
                </button>
              </Link>
              <input type="checkbox" id="ham-menu-switch" class="hidden">
              <label for="ham-menu-switch" class="ham-menu">
                <div class="downMenu">
                  <img :src="images.more_vert" width="25" height="25" alt="">
                </div>
              </label>
              <div id="menu">
                <CopyDocument v-if="show1"></CopyDocument>
                <TrashCanModal v-if="show2"></TrashCanModal>
                <AddCollaborator v-if="show4" :co-form-id="coFormId"></AddCollaborator>
                <div class="">
                  <button type="button" class="option" @click="open(1)"><img :src="images.content_copy" alt=""><span>建立副本</span></button>
                  <button type="button" class="option" @click="open(2)"><img :src="images.del" alt=""><span>移至垃圾桶</span></button>
                  <button type="button" class="option"><img :src="images.link" alt=""><span>取得預先填入的連結</span></button>
                  <button type="button" class="option" @click="open()"><img :src="images.print" alt=""><span>列印</span></button>
                  <button type="button" class="option" @click="open(4)"><img :src="images.group_add" alt=""><span>新增協作者</span></button>
                </div>
              </div>
              <input type="checkbox" id="ham-menu-switch-2" class="hidden">
              <label for="ham-menu-switch-2" class="ham-menu">
                <div class="account">
                  <img :src="images.account" alt="">
                </div>
              </label>
              <div id="account-menu">
                <div class="google">
                  <div class="option">asd783738777@gmail.com</div>
                  <img class="photo" :src="images.user" alt="">
                  <div class="hello"><span>user</span>，你好!</div>
                  <div class="acc mb-3">
                    <Link class="manage" :href="route('dashboard')">
                      <div>管理你的帳戶</div>
                    </Link>
                    <DropdownLink :href="route('logout')" method="post" as="button" class="log-out">
                      登出
                    </DropdownLink>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="down">
            <NavLink class="btn" :href="route('edit.index')" :active="currentUrl('edit.index')">
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
    <main id="main" :class="myStyle()">
      <div class="fixed top-0 w-full h-screen bg-white opacity-80"></div>
      <slot />
    </main>
  </section>
</template>

<style lang="scss" scoped>
#frontend-layout {
  @apply w-full mt-[107px];
}

#main {
  @apply h-auto relative;
}

#header {
  @apply fixed w-full top-0 z-50;
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
                  @apply shadow-lg w-[350px] absolute right-0 top-[107px] bg-white;
                  .topic-head {
                  @apply px-[20px] w-full flex justify-between items-center drop-shadow-sm;
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
                      @apply

                       hover:rounded-full hover:bg-[#e5e5e5];
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
                        @apply flex w-[30px] h-[30px] rounded-full ml-[10px] justify-center items-center hover:drop-shadow-sm hover:scale-110 cursor-pointer;
                        .add {
                          @apply w-[24px];
                        }
                      }
                    }
                  }
                }
                .eye {
                  @apply w-[45px] h-[45px] flex justify-center items-center hover:bg-[#ededed] rounded-[50%];
                }
                #menu {
                  @apply w-[256px] bg-white border border-[gainsboro] rounded-[2px] mt-[5px] hidden shadow-lg absolute top-[50px] right-[50px];
                }
                .option {
                  @apply w-full mx-0 px-4 leading-[30px] text-[#505050] flex font-bold items-center justify-start;
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
                  @apply w-[45px] h-[45px] flex justify-center items-center hover:bg-[#ededed] rounded-[50%] cursor-pointer;
                }
                #account-menu {
                  @apply w-[350px] h-[300px] bg-purple-dark border border-[gainsboro] px-[10px] py-[15px] rounded-[30px] hidden shadow-lg absolute top-[80px] right-[30px] z-[1];
                    .google {
                      @apply w-[100%] h-[100%] flex-col flex justify-between items-center;
                        .photo {
                          @apply w-[100px] h-[100px] rounded-[50%] opacity-70;
                        }
                        .hello {
                          @apply w-[80%] h-[30px] text-xl flex justify-center items-center;
                        }
                        .acc {
                          @apply w-[80%] h-[50px] flex flex-row justify-between;
                            .manage {
                              @apply w-[59.5%] h-[50px] flex justify-center items-center bg-grey-gray drop-shadow-md border border-grey rounded-l-[30px] hover:bg-white hover:drop-shadow-lg hover:font-semibold;
                            }
                            .log-out {
                              @apply w-[39.5%] h-[50px] border border-grey drop-shadow-md rounded-r-[30px] flex justify-center items-center bg-grey-gray hover:bg-white hover:drop-shadow-lg hover:font-semibold;
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

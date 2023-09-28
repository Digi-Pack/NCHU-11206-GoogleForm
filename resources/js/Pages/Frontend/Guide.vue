<script>
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
import view_list from '/images/view_list.png';
import sort_by_alpha from '/images/sort_by_alpha.png';
import favicon_qp2 from '/images/favicon_qp2.png';
import dot from '/images/dot.png';

export default {
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
        sort_by_alpha,
        view_list,
        favicon_qp2,
        dot,
      },
      show: false,
    };
  },
};
</script>

<template>
  <section id="guide">
    <nav>
      <div class="container">
        <div class="top">
          <div class="topL flex justify-start items-center">
            <div class="square logo"><img :src="images.logo" width="25" alt=""></div>
            <span class="title">表單</span>
          </div>
          <input type="text" class="search" placeholder="搜尋">
          <div class="topR">
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
                <div class="acc mb-3">
                  <div class="add">新增帳戶</div>
                  <div class="log-out">登出</div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="controlBar">
        <span>最近的表單</span>
        <div class="flex gap-20 justify-center items-center">
          <select name="ownerType" id="">
            <option value="">不限擁有者</option>
            <option value="">我擁有的項目</option>
            <option value="">不歸我所有</option>
          </select>
          <div class="flex items-center gap-2 pr-10">
            <button type="button" class="w-[40px] h-[40px] flex justify-center items-center rounded-full hover:bg-grey-light">
              <img :src="images.view_list" width="23" alt="">
            </button>
            <input type="checkbox" class="hidden" id="sort">
            <label for="sort">
              <div class="w-[40px] h-[40px] flex justify-center items-center rounded-full hover:bg-grey-light cursor-pointer">
                <img :src="images.sort_by_alpha" class="w-[23px]" alt="">
              </div>
            </label>
            <div id="sortMenu">
              <button type="button">我上次開啟的時間</button>
              <button type="button">我上次修改的時間</button>
              <button type="button">上次修改的時間</button>
              <button type="button">標題</button>
            </div>
          </div>
        </div>
      </div>
    </nav>
    <div class="main">
      <div class="card-group">
        <div class="card">
          <div class="card-top"></div>
          <div class="card-bottom">
            <div class="text-[14px]">未命名表單</div>
            <div class="flex gap-3 items-center">
              <img :src="images.favicon_qp2" class="rounded-sm" alt="">
              <span class="text-[12px] leading-1">開啟時間 上午11:43</span>
              <input type="checkbox" class="hidden" id="card-option">
              <label for="card-option">
                <div class="w-[20px] h-[20px] flex justify-center items-center rounded-full hover:bg-grey-light cursor-pointer">
                  <img :src="images.dot" alt="">
                </div>
              </label>
              <div id="card-option-menu">
                <button type="button">重新命名</button>
                <button type="button"><img :src="images.del" alt="">移除</button>
                <button type="button">在新分頁開啟</button>
              </div>
            </div>
          </div>
        </div>
        <div class="card"></div>
        <div class="card"></div>
        <div class="card"></div>
        <div class="card"></div>
        <div class="card"></div>
      </div>
    </div>
  </section>
</template>

<style lang="scss" scoped>
#guide {
  nav {
    .container {
      @apply flex h-[64px] flex-col justify-between bg-[#ededed] relative;
        .top {
          @apply h-full bg-white flex justify-between p-[10px];
            .topL {
                .logo {
                    @apply mx-[10px];
                }
                .title {
                  @apply text-[#202124] text-[18px] font-medium;
                }
            }
            .search {
              @apply bg-grey-light flex justify-center items-center rounded-md border-0 w-[45%] focus:ring-0 focus:bg-white focus:drop-shadow-md;
            }
            .topR {
                @apply flex justify-between items-center;
                button {
                  @apply flex w-[45px] h-[45px] justify-center items-center mx-[5px];
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
                  @apply w-[30px] h-[30px] bg-purple rounded-[50%] mr-5;
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
    }
    .controlBar {
      @apply flex w-full h-[64px] px-[12%] justify-between items-center relative mb-5;
      select {
        @apply border-0 w-[55%] h-[45%] py-0 rounded-md hover:bg-grey-light focus:ring-0;
      }
      #sort:checked~#sortMenu {
        @apply block;
      }
      #sortMenu {
          @apply border bg-white z-10 border-green-light py-5 w-[210px] absolute top-[60px] right-[100px] shadow-md drop-shadow-md hidden;
          button {
            @apply w-full hover:bg-grey-light;
          }
      }
    }
  }
  .main {
    @apply w-full px-[12%];
    .card-group {
      @apply flex flex-wrap gap-5;
      .card {
        @apply w-[208px] h-[244px] border border-grey-middle hover:border-purple;
        .card-top {
          @apply h-[70%] bg-grey-dark;
        }
        .card-bottom {
          @apply h-[30%] w-full px-5 py-2 border-grey-middle border-t relative;
          #card-option:checked~#card-option-menu {
            @apply block;
          }
          #card-option-menu {
            @apply border bg-white border-green-light py-5 w-[210px] absolute top-[60px] -right-[80px] shadow-md drop-shadow-md hidden;
            button {
            @apply w-full hover:bg-grey-light flex justify-center gap-10;
            }
          }
        }
      }
    }
  }
}
</style>

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
import view_module from '/images/view_module.png';
import sort_by_alpha from '/images/sort_by_alpha.png';
import favicon_qp2 from '/images/favicon_qp2.png';
import addnewform from '/images/addnewform.png';
import dot from '/images/dot.png';
import text from '/images/text.png';
import user from '/images/user.svg';
import open_in_new from '/images/open_in_new.png';
// import RenameModal from '@/Components/Modal/RenameModal.vue';
import Swal from 'sweetalert2';
import { router } from '@inertiajs/vue3';
export default {
//   components: { RenameModal },
  props: {
    response: {
      type: Object,
      required: true,
      default: () => {
        return {};
      },
    },
    // modalData: Object,
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
        sort_by_alpha,
        view_list,
        favicon_qp2,
        dot,
        text,
        open_in_new,
        view_module,
        addnewform,
        user,
      },
      show: false,
      blockShow: false,
      isMenuOpen: {},
      modalData: {
        // 你要传递的数据
        id: '',
        newName: '',
      },
    };
  },
  mounted() {
    // const buttonElement = this.$refs.menuButton;
    // buttonElement.setAttribute('tabindex', '0');
  },
  methods: {
    toggleMenu(id) {
      this.isMenuOpen[id] = !this.isMenuOpen[id];
    },
    listChange() {
      this.blockShow = !this.blockShow;
    },
    open(id) {
      const { modalData } = this;
      this.show = !this.show;
      this.isMenuOpen[id] = false;
      modalData.id = id;
    },
    closing() {
      this.show = !this.show;
    },
    closeMenu(id) {
      Swal.fire({
        title: '要確欸',
        text: '此筆刪除將會無法回復!',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: '刪除',
        cancelButtonText: '取消',
      }).then((result) => {
        if (result.isConfirmed) {
          router.visit(route('edit.delete'), {
            method: 'delete', data: { id }, preserveState: true,
            onSuccess: ({ props }) => {
              if (props.flash.message.rt_code === 1) {
                Swal.fire(
                  '刪除成功',
                  '此表單已被刪除',
                );
              }
            },
          });

        }
      });
      this.isMenuOpen[id] = false;
    },
    sendName() {
      this.show = !this.show;
      const { modalData } = this;
      router.visit(route('edit.rename'), {
        method: 'post', data: { modalData }, preserveState: true,
        onSuccess: ({ props }) => {
          if (props.flash.message.rt_code === 1) {
            Swal.fire(
              '已修改表單標題',
            );
          }
        },
      });
    },
  },
};
</script>

<template>
  <!-- {{ response }} -->
  <!-- {{ response.rt_data[0].id }} -->
  {{ modalData.id }}
  <section id="guide">
    <!-- <RenameModal v-if="show" :data="modalData">
    </RenameModal> -->
    <section v-if="show" id="RenameModal">
      <div class="container">
        <div class="content">
          <div class="flex justify-between items-center">
            <h1 class="text-[24px] text-black">重新命名</h1>
            <button type="button" class="text-[28px] font-bold text-black" @click="closing()">
              <img :src="close" alt="">
            </button>
          </div>
          <div class="pt-[15px]">
            <div>
              <div class="text-gray-400 text-lg">請輸入新的項目名稱:</div>
              <input v-model=" modalData.newName " type="text" class="rounded-[5px] leading-5 mt-5 w-full">
            </div>
            <div class="flex justify-end mt-7">
              <button type="button" class="btn px-5 py-2 border border-grey text-purple hover:bg-blue-light hover:shadow rounded-[10px] mr-3"
                @click="closing()">取消</button>
              <button type="button"
                class="btn px-5 py-2 rounded-[10px] bg-blue text-white hover:shadow hover:shadow-gray-400" @click="sendName()">確定</button>
            </div>
          </div>
        </div>
      </div>
    </section>
    <nav>
      <div class="container">
        <div class="top">
          <div class="topL flex justify-start items-center">
            <div class="square logo"><img :src="images.logo" width="25" alt=""></div>
            <span class="title">表單</span>
          </div>
          <!-- 搜尋欄 -->
          <input type="text" class="search" placeholder="搜尋">
          <div class="topR">
            <input type="checkbox" id="ham-menu-switch-2" class="hidden">
            <label for="ham-menu-switch-2" class="ham-menu">
              <div class="account"></div>
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
                  <div class="log-out">登出</div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="controlBar">
        <span>最近的表單</span>
        <div class="flex w-[32%] justify-between items-center" :class="{ '!w-[52%]': blockShow }">
          <select name="ownerType" id="">
            <option value="">不限擁有者</option>
            <option value="">我擁有的項目</option>
            <option value="">不歸我所有</option>
          </select>
          <span class="w-auto" v-if="blockShow">我上次開啟的時間</span>
          <div class="flex items-center gap-2 pr-6">
            <button type="button" v-if="!blockShow" class="w-[40px] h-[40px] flex justify-center items-center rounded-full hover:bg-grey-light" @click="listChange()">
              <img :src="images.view_list" width="23" alt="">
            </button>
            <button type="button" v-if="blockShow" class="w-[40px] h-[40px] flex justify-center items-center rounded-full hover:bg-grey-light" @click="listChange()">
              <img :src="images.view_module" width="23" alt="">
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
      <div v-if="!blockShow" class="card-group">
        <!-- 表單方格 -->
        <div class="card" v-for="item in response.rt_data" :key="item.id">
          <Link :href="route('edit.old', { id: item.id })">
            <div class="card-top">
              <!-- 預覽頁面 -->
            </div>
          </Link>
          <div class="card-bottom">
            <div class="text-[14px] w-[140px] truncate">{{ item.qu_naires_title }}</div>
            <div class="flex gap-3 items-center">
              <img :src="images.favicon_qp2" class="rounded-sm" alt="">
              <span class="text-[12px] leading-1">開啟時間 上午11:43</span>
              <button type="button" class="w-[20px] h-[20px] flex justify-center items-center rounded-full hover:bg-grey-light cursor-pointer" @click="toggleMenu(item.id)" tabindex="0">
                <img :src="images.dot" alt="">
              </button>
              <div class="card-option-menu" v-if="isMenuOpen[item.id]">
                <button type="button" @click="open(item.id)"><img :src="images.text" class="opacity-60" alt="">重新命名</button>
                <button type="button" @click="closeMenu(item.id)"><img :src="images.del" class="opacity-60" alt="">移除</button>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div v-if="blockShow" class="list-group">
        <div class="list" v-for="item in response.rt_data" :key="item.id">
          <Link :href="route('edit.old', { id: item.id })">
            <div class="flex items-center gap-10">
              <img :src="images.favicon_qp2" class="rounded-sm" alt="">
              <span class="w-[200px] truncate">{{ item.qu_naires_title }}</span>
            </div>
          </Link>
          <div class="flex items-center justify-between w-[45%]">
            <span>我</span>
            <span>2023年9月28日</span>
            <button type="button" class="w-[20px] h-[20px] flex justify-center items-center rounded-full hover:bg-purple-light cursor-pointer" @click="toggleMenu(item.id)">
              <img :src="images.dot" alt="">
            </button>
            <div class="card-option-menu" v-if="isMenuOpen[item.id]" @blur="closeMenu(item.id)" tabindex="0">
              <button type="button" @click="open(item.id)"><img :src="images.text" class="opacity-60" alt="">重新命名</button>
              <button type="button" @click="closeMenu(item.id)"><img :src="images.del" class="opacity-60" alt="">移除</button>
            </div>
          </div>
        </div>
      </div>
    </div>
    <button type="button" class="w-[60px] rounded-full drop-shadow-md border-grey shadow-lg bg-white p-3 fixed bottom-10 right-10"><img :src="images.addnewform" alt=""></button>
  </section>
</template>
<!-- <div v-for="item in response.rt_data" :key="item.id">
    <h1>{{ item.qu_naires_title }}</h1>
    <Link :href="route('edit.old', { id: item.id })">
      <button type="button" class="px-6 py-3 border border-black rounded-[5px]">編輯</button>
    </Link>
  </div> -->

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
                .account {
                  @apply w-[30px] h-[30px] bg-purple rounded-[50%] mr-5;
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
    }
    .controlBar {
      @apply flex w-full h-[64px] px-[17%] text-[15px] justify-between items-center relative mb-5;
      select {
        @apply border-0 h-[45%] text-[14px] px-4 py-1 rounded-md hover:bg-grey-light focus:ring-0;
      }
      #sort:checked~#sortMenu {
        @apply block;
      }
      #sortMenu {
          @apply border bg-white z-10 border-green-light py-2 w-[210px] absolute top-[60px] right-[200px] shadow-md drop-shadow-md hidden;
          button {
            @apply w-full hover:bg-grey-light flex justify-start px-5 gap-5 py-2;
          }
      }
    }
  }
  .main {
    @apply w-full px-[17%];
    .card-group {
      @apply flex flex-wrap gap-5;
      .card {
        @apply w-[208px] h-[244px] border border-grey-middle hover:border-purple;
        .card-top {
          @apply h-[70%] bg-grey-dark;
        }
        .card-bottom {
          @apply h-[30%] w-full px-5 py-2 border-grey-middle border-t relative;
        //   #card-option:checked~#card-option-menu {
        //     @apply block;
        //   }
          .card-option-menu {
            @apply border bg-white border-green-light py-2 w-[210px] absolute top-[60px] -right-[80px] shadow-md drop-shadow-md;
            button {
            @apply w-full hover:bg-grey-light flex justify-start px-5 gap-5 py-2;
            }
          }
        }
      }
    }
    .list-group {
      @apply pr-10;
      .list {
        @apply flex items-center justify-between rounded-[25px] relative hover:bg-purple-light py-2 px-4;
        span {
          @apply leading-[31px] text-[14px] text-gray-500;
        }
        .card-option-menu {
          @apply border bg-white border-green-light py-2 w-[210px] z-10 absolute top-[40px] -right-[80px] shadow-md drop-shadow-md;
          button {
          @apply w-full hover:bg-grey-light flex justify-start px-5 gap-5 py-2;
          }
        }
      }
    }
  }
}
#RenameModal {
  .container {
    @apply w-full h-screen fixed top-0 left-0 bg-[#0101015a] z-10;

    .content {
      @apply w-[500px] h-[300px] bg-white rounded-xl border shadow-lg absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 p-8;
    }
  }
}
</style>

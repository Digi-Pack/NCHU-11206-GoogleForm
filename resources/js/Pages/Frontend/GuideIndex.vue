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
import description from '/images/description.svg';
import account from '/images/account_circle.svg';
import open_in_new from '/images/open_in_new.png';
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
        account,
        description,
      },
      show: false,
      blockShow: false,
      isMenuOpen: {},
      modalData: {
        // 你要传递的数据
        id: '',
        newName: '',
      },
      selectShow: {
        keyword: '',
        owner: 1,
        sort: 1,
      },
    };
  },
  mounted() {
    sessionStorage.removeItem('formData');
    sessionStorage.removeItem('formText');
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
        title: '確定刪除嗎?',
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
      if (modalData.newName) {
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
      }
      modalData.newName = '';
    },
    changeResponse() {
      const { selectShow } = this;
      router.visit(route('guide.index'), {
        method: 'get', data: selectShow, preserveState: true,
      });
    },
    // 顯示開啟時間
    opentimes(opendate) {
      if (!opendate) { return ''; }
      const dateTime = new Date(`${opendate}`);
      const year = dateTime.getFullYear();
      const month = dateTime.getMonth();
      const day = dateTime.getDate();
      return `${year}年${month + 1}月${day}日`;
    },
  },
};
</script>

<template>
  <section id="guide">
    <section v-if="show" id="RenameModal">

      <div class="container">
        <div class="content">
          <div class="flex justify-between items-center">
            <h1 class="text-[24px] text-black">重新命名</h1>
            <button type="button" class="text-[28px] font-bold text-black" @click="closing()"></button>
          </div>
          <div class="pt-[15px]">
            <div>
              <div class="text-gray-400 text-lg">請輸入新的項目名稱:</div>
              <input v-model="modalData.newName" type="text" placeholder="請輸入新的名稱"
                class="rounded-[5px] leading-5 mt-5 w-full">
            </div>
            <div class="flex justify-end mt-7">
              <button type="button"
                class="btn px-5 py-2 border border-grey text-purple hover:bg-blue-light hover:shadow rounded-[10px] mr-3"
                @click="closing()">取消</button>
              <button type="button"
                class="btn px-5 py-2 rounded-[10px] bg-blue text-white hover:shadow hover:shadow-gray-400"
                @click="sendName()">確定</button>
            </div>
          </div>
        </div>
      </div>
    </section>
    <nav>
      <div class="container">
        <div class="top">
          <div class="topL">
            <div class="square logo"><img :src="images.logo" width="25" height="25" alt=""></div>
            <span class="title">表單</span>
          </div>
          <!-- 搜尋欄 -->
          <div class="flex w-full justify-center">
            <input v-model="selectShow.keyword" type="text" class="search" placeholder="輸入表單名稱...">
            <button type="button"
              class="bg-grey text-white py-[10px] px-[10px] duration-200 rounded-r-lg hover:bg-grey-dark hover:text-gray-700"
              @click="changeResponse()">搜尋</button>
          </div>
          <div class="topR">
            <!-- 帳戶 -->
            <input type="checkbox" id="ham-menu-switch-2" class="hidden">
            <label for="ham-menu-switch-2" class="ham-menu">
              <img class="account" :src="images.account" alt="">
            </label>
            <div id="account-menu">
              <div class="google">
                <div class="option">{{ response.rt_data.user.email }}</div>
                <img class="photo" :src="images.user" alt="">
                <div class="hello"><span>{{ response.rt_data.user.name }}</span>，你好!</div>
                <div class="acc mb-3">
                  <DropdownLink :href="route('logout')" method="post" as="button" class="log-out">
                    登出
                  </DropdownLink>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="controlBar">
        <span>最近的表單</span>
        <div class="flex w-[42%] justify-between items-center">
          <select name="ownerType" v-model="selectShow.owner" id="" @change="changeResponse()">
            <option value="1">不限擁有者</option>
            <option value="2">我擁有的項目</option>
            <option value="3">不歸我所有</option>
          </select>
          <div class="flex items-center gap-2 pr-6">
            <button type="button" v-if="!blockShow"
              class="w-[40px] h-[40px] flex justify-center items-center rounded-full hover:bg-grey-light"
              @click="listChange()">
              <img :src="images.view_list" width="23" alt="">
            </button>
            <button type="button" v-if="blockShow"
              class="w-[40px] h-[40px] flex justify-center items-center rounded-full hover:bg-grey-light"
              @click="listChange()">
              <img :src="images.view_module" width="23" alt="">
            </button>
            <select name="sortType" v-model="selectShow.sort" @change="changeResponse()">
              <option value="1">我上次開啟的時間</option>
              <option value="2">我上次修改的時間</option>
              <option value="3">上次修改的時間</option>
              <option value="4">標題</option>
            </select>
          </div>
        </div>
      </div>
    </nav>
    <div class="main">
      <div v-if="!blockShow" class="card-group">
        <!-- 表單方格 -->
        <div class="card" v-for="item in response.rt_data.guide " :key="item.id">
          <Link :href="route('edit.old', { id: item.id })">
            <div class="card-top">
              <!-- 預覽頁面 -->
              <img :src="images.description" class="w-[50%] opacity-40 object-covAer" alt="">
            </div>
          </Link>
          <div class="card-bottom">
            <div class="card-bottom-title">{{ item.qu_naires_title }}
              <span class="hiddenText">{{ item.qu_naires_title }}</span>
            </div>
            <div class="flex items-center justify-around">
              <img :src="images.favicon_qp2" class="rounded-sm" alt="">
              <div class="w-auto whitespace-nowrap text-[11px] leading-1 ml-2"> <span>開啟時間</span> {{ opentimes(item.opened_date) }}</div>
              <button type="button" class="w-[20px] h-[20px] flex justify-center items-center rounded-full hover:bg-grey-light cursor-pointer" @click="toggleMenu(item.id)" tabindex="0">
                <img :src="images.dot" alt="">
              </button>
              <div class="card-option-menu" v-if="isMenuOpen[item.id]">
                <button type="button" @click="open(item.id)"><img :src="images.text" class="opacity-60"
                  alt="">重新命名</button>
                <button type="button" @click="closeMenu(item.id)"><img :src="images.del" class="opacity-60"
                  alt="">移除</button>
              </div>
            </div>
          </div>
        </div>
        <div class="card opacity-0 !h-0 overflow-hidden pointer-events-none"></div>
        <div class="card opacity-0 !h-0 overflow-hidden pointer-events-none"></div>
        <div class="card opacity-0 !h-0 overflow-hidden pointer-events-none"></div>
        <div class="card opacity-0 !h-0 overflow-hidden pointer-events-none"></div>
      </div>
      <div v-if="blockShow" class="list-group">
        <div class="list" v-for="item in response.rt_data.guide " :key="item.id">
          <Link :href="route('edit.old', { id: item.id })">
            <div class="flex items-center gap-10">
              <img :src="images.favicon_qp2" class="rounded-sm" alt="">
              <span class="w-[200px] truncate">{{ item.qu_naires_title }}</span>
            </div>
          </Link>
          <div class="flex items-center justify-between w-[35%]">
            <span>{{ opentimes(item.opened_date) }}</span>
            <button type="button"
              class="w-[20px] h-[20px] flex justify-center items-center rounded-full hover:bg-purple-light cursor-pointer"
              @click="toggleMenu(item.id)">
              <img :src="images.dot" alt="">
            </button>
            <div class="card-option-menu" v-if="isMenuOpen[item.id]" @blur="closeMenu(item.id)" tabindex="0">
              <button type="button" @click="open(item.id)"><img :src="images.text" class="opacity-60" alt="">重新命名</button>
              <button type="button" @click="closeMenu(item.id)"><img :src="images.del" class="opacity-60"
                alt="">移除</button>
            </div>
          </div>
        </div>
      </div>
    </div>
    <Link :href="route('edit.index')">
      <button type="button"
        class="newformbtn w-[60px] rounded-full drop-shadow-md border border-grey-light bg-white p-3 duration-500 fixed bottom-10 right-10 hover:scale-110 hover:drop-shadow-xl">
        <img :src="images.addnewform" class="addnewform" alt="">
      </button>
    </Link>
  </section>
</template>

<style lang="scss" scoped>
#guide {
  @apply min-h-screen;

  nav {
    @apply fixed w-full z-50;

    .container {
      @apply flex h-[64px] flex-col justify-between bg-[#ededed] relative;

      .top {
        @apply h-full bg-white flex justify-between p-[10px];

        .topL {
          @apply flex justify-start items-center;

          .logo {
            @apply mx-[10px] w-[30px];
          }

          .title {
            @apply text-[#202124] text-[18px] font-medium w-[50px];
          }
        }

        .search {
          @apply bg-grey-light flex justify-center items-center rounded-l-lg border-0 w-[45%] focus:ring-0 focus:bg-white focus:drop-shadow-md;
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
            @apply w-[230px] my-[12.5px] leading-[30px] text-[#505050] flex font-bold items-center justify-center;

            span {
              @apply ms-[10px];
            }
          }

          #ham-menu-switch:checked~#menu {
            @apply block;
          }

          .account {
            @apply w-[40px] h-[40px] rounded-[50%] mr-5 cursor-pointer opacity-70;
          }

          #account-menu {
            @apply w-[300px] h-[300px] bg-purple-dark border border-[gainsboro] px-[10px] py-[15px] rounded-[30px] hidden shadow-lg absolute top-[80px] right-[30px] z-[1];

            .google {
              @apply w-[100%] h-[100%] flex-col flex justify-between items-center;

              .photo {
                @apply w-[100px] h-[100px] rounded-[50%] opacity-70;
              }

              .hello {
                @apply w-[80%] h-[30px] text-xl flex justify-center items-center;
              }

              .acc {
                @apply w-[80%] h-[50px] flex justify-center;

                .log-out {
                  @apply w-[39.5%] h-[50px] border border-grey-light duration-300 drop-shadow-sm cursor-pointer rounded-[30px] text-xl bg-grey-gray hover:bg-white hover:drop-shadow-lg hover:font-semibold;
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
      @apply flex w-full bg-white h-[64px] px-[13%] text-[15px] justify-between items-center relative mb-5;

      select {
        @apply border-0 h-[45%] text-[14px] pr-7 py-1 rounded-md hover:bg-grey-light focus:ring-0;
      }
    }
  }

  .main {
    @apply w-full px-[13%] relative top-[138px] pb-24;

    .card-group {
      @apply flex flex-wrap gap-5 justify-center;
      .card {
        @apply w-[208px] h-[244px] border border-grey-middle cursor-pointer hover:border-purple;

        .card-top {
          @apply h-[60%] bg-grey-light flex justify-center items-center;
        }

        .card-bottom {
          @apply h-[40%] w-full px-3 py-2 border-grey-middle border-t relative flex flex-col gap-5 justify-center;
          .card-bottom-title {
            @apply text-[14px] w-[140px] truncate;
            &:hover .hiddenText {
              @apply block;
            }
            .hiddenText {
              @apply max-w-[250px] whitespace-normal break-words bg-[#5b5b5bbb] text-white rounded-md absolute px-2 leading-6 top-[35px] left-[80px] z-10 hidden text-[12px];
            }
          }
        //   #card-option:checked~#card-option-menu {
        //     @apply block;
        //   }
          .card-option-menu {
            @apply border bg-white border-green-light py-2 w-[210px] absolute top-[85px] -right-[80px] shadow-md drop-shadow-md z-50;

            button {
              @apply w-full hover:bg-grey-light flex justify-start px-5 gap-5 py-2;
            }
          }
        }
      }

      .card:hover .card-top img {
        @apply scale-110 opacity-60 duration-200;
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

  .newformbtn:hover .addnewform {
    @apply rotate-[360deg] scale-125 duration-1000;
  }
}

#RenameModal {
  .container {
    @apply w-full h-screen fixed top-0 left-0 bg-[#0101015a] z-10;

    .content {
      @apply w-[500px] h-[300px] bg-white rounded-xl border shadow-lg absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 p-8;
    }
  }
}</style>

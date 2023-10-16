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
import account from '/images/account_circle.svg';
import { colorType } from '@/Composables/useBgColor';
import { router } from '@inertiajs/vue3';

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
      model: '123',
      showTopic: false,
      bgColor: 'bg-purple',
      qu_naires_title: '',
      formTitle: '',
      colorType,
      coFormId: route()?.params?.id ?? '0',
      preview: true,
      menuShow: false,
    };
  },
  watch: {
    '$page.url': function () {
      this.coFormId = route()?.params?.id ?? '0';
    },
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
    changeColor(newColor) {
      let myNewColor = `${newColor}`;
      this.bgColor = myNewColor;
    },
    myStyle() {
      return this.bgColor;
    },
    topicOpen() {
      this.showTopic = !this.showTopic;
    },
    handleClose() {
      this.model = '';
    },
    changeFormName(val) {
      this.qu_naires_title = val;
    // 這樣就可以接收到來自子組件的值
    },
    submitData() {
      //   将字符串轉换为對象;
      const { coFormId } = this;
      const formDataobj = JSON.parse(sessionStorage.getItem('formData'));
      const formTextobj = JSON.parse(sessionStorage.getItem('formText'));

      router.visit(route('edit.store'), {
        method: 'post', data: { formDataobj, formTextobj, preview: true, coFormId: coFormId }, preserveState: true,
      });
    },
    // 開關功能選單
    openMenu() {
      this.menuShow = !this.menuShow;
    },
    // 列印
    print() {
      const element = this.$refs.menu; // 替換 'yourElement' 為你想要隱藏的DOM元素的參考名稱
      element.style.display = 'none';
      window.print();
      element.style.display = 'block';
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
              <span class="title truncate">
                {{ formTitle }}
              </span>
            </div>
            <div class="topR">
              <button type="button" class="paletteB" @click="topicOpen()"><img :src="images.palette" width="25" height="25" alt=""></button>
              <div v-if="showTopic" class="topic z-50">
                <div class="topic-head">
                  <div class="top-text">
                    <img class="palette" :src="images.palette" alt="">
                    <span>主題顏色</span>
                  </div>
                  <button type="button" class="close" @click="topicOpen()"><img :src="images.close" alt=""></button>
                </div>
                <div class="topic-body">
                  <div class="page-color mb-[20px]">
                    <div class="text-[18px] font-semibold mb-[10px]">顏色</div>
                    <div class="colorbox-all">
                      <div class="col">
                        <button type="button" class="colorbox" :class="color.name" @click="changeColor(color.name)" v-for="color in colorType" :key="color.id"></button>
                        <div class="bg-red hidden"></div>
                        <div class="bg-purple hidden"></div>
                        <div class="bg-indigo hidden"></div>
                        <div class="bg-blue hidden"></div>
                        <div class="bg-light-blue hidden"></div>
                        <div class="bg-cyan-blue hidden"></div>
                        <div class="bg-orange-red hidden"></div>
                        <div class="bg-orange hidden"></div>
                        <div class="bg-blue-green hidden"></div>
                        <div class="bg-green hidden"></div>
                        <div class="bg-blue-gray hidden"></div>
                        <div class="bg-grey hidden"></div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <button type="button" class="eye" @click="submitData()">
                <img :src="images.visibility" width="25" height="25" alt="">
              </button>
              <input type="checkbox" id="ham-menu-switch" class="hidden">
              <div v-if="coFormId !== '0'" class="downMenu">
                <button type="button" class="ham-menu" @click="openMenu()">
                  <img :src="images.more_vert" width="25" height="25" alt="">
                </button>
              </div>
              <div id="menu" v-if="menuShow" ref="menu">
                <CopyDocument v-if="model === 'CopyDocument'" @close-model="handleClose" :co-form-id="coFormId"></CopyDocument>
                <TrashCanModal v-if="model === 'TrashCanModal'" @close-model="handleClose" :co-form-id="coFormId" :form-title="formTitle"></TrashCanModal>
                <AddCollaborator v-if="model === 'AddCollaborator'" :co-form-id="coFormId" @close-model="handleClose"></AddCollaborator>
                <div v-if="coFormId !== '0'" class="">
                  <button v-if="coFormId !== '0'" type="button" class="option" @click="model = 'CopyDocument'"><img :src="images.content_copy" alt=""><span>建立副本</span></button>
                  <button v-if="coFormId !== '0'" type="button" class="option" @click="model = 'TrashCanModal'"><img :src="images.del" alt=""><span>刪除表單</span></button>
                  <button v-if="coFormId !== '0'" type="button" class="option" @click="print()"><img :src="images.print" alt=""><span>列印</span></button>
                  <button v-if="coFormId !== '0'" type="button" class="option" @click="model = 'AddCollaborator'"><img :src="images.group_add" alt=""><span>新增協作者</span></button>
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
                  <div class="option !justify-center" @userInform="userInformation">{{ $page.props.auth.user.email }}</div>
                  <img class="photo" :src="images.user" alt="">
                  <div class="hello"><span>{{ $page.props.auth.user.name }}</span>，你好!</div>
                  <div class="acc mb-3">
                    <DropdownLink :href="route('logout')" method="post" as="button" class="log-out">
                      登出
                    </DropdownLink>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="down">
            <NavLink class="btn" :href="route('edit.old', { id: coFormId })" :active="currentUrl('edit.index')">
              問題
            </NavLink>
            <NavLink class="btn" :href="route('response.sum', { id: coFormId })" :active="currentUrl('response.sum')">
              回覆
            </NavLink>
            <NavLink class="btn" :href="route('profile.edit', { id: coFormId })" :active="currentUrl('profile.edit')">
              帳戶
            </NavLink>
          </div>
        </div>
      </nav>
    </header>
    <main id="main" :class="myStyle()">
      <div class="fixed top-0 w-full h-full bg-white opacity-90"></div>
      <slot />
    </main>
  </section>
</template>

<style lang="scss" scoped>
#frontend-layout {
  @apply w-full mt-[107px];
  @media (max-width: 560px) {
    @apply overflow-y-hidden;
  }
}

#main {
  @apply min-h-full w-full relative;
}

#header {
  @apply fixed w-full top-0 z-50;
}

nav {
    .container {
      @apply flex h-[107px] flex-col justify-between bg-[#ededed] relative;
      @media (max-width: 560px) {
        @apply h-[147px];
      }
        .top {
          @media (max-width: 560px) {
            @apply h-[70%];
          }
            .topL {
              @media (max-width: 560px) {
                @apply flex-col items-start justify-between;
              }
                .logo {
                    @apply mx-[10px];
                }
                .title {
                  @apply text-[#202124] text-[18px] w-[300px] font-medium;
                  @media (max-width: 560px) {
                    @apply w-[150px];
                  }
                }
            }
            .topR {
                @apply flex justify-between items-center;
                @media (max-width: 560px) {
                  @apply self-start;
                }
                button {
                  @apply flex w-[45px] h-[45px] justify-center items-center mx-[5px];
                }
                .paletteB {
                  @apply flex w-[45px] h-[45px] cursor-pointer justify-center items-center me-[5px] hover:bg-[#ededed] rounded-[50%];
                }

                .topic {
                  @apply shadow-lg w-[350px] absolute right-0 top-[107px] bg-white;
                  @media (max-width: 560px) {
                    @apply top-[147px];
                  }
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
                    @apply px-[20px] py-[10px];
                    .col {
                      @apply flex flex-wrap mb-[10px];
                      .colorbox {
                        @apply flex w-[30px] h-[30px] rounded-full ml-[10px] mb-[10px] justify-center items-center hover:drop-shadow-sm hover:scale-110 cursor-pointer;
                      }
                    }
                  }
                }
                .eye {
                  @apply w-[45px] h-[45px] flex justify-center items-center hover:bg-[#ededed] rounded-[50%];
                }
                #menu {
                  @apply w-[256px] bg-white border border-[gainsboro] rounded-[2px] mt-[5px] shadow-lg absolute top-[50px] right-[50px];
                }
                .option {
                  @apply w-full mx-0 px-4 leading-[30px] text-[#505050] flex font-bold items-center justify-start;
                    span {
                        @apply ms-[10px];
                    }
                }
                .downMenu {
                  @apply w-[45px] h-[45px] cursor-pointer flex justify-center items-center me-[5px] hover:bg-[#ededed] rounded-[50%];
                }
                .account {
                  @apply w-[45px] h-[45px] flex justify-center items-center hover:bg-[#ededed] rounded-[50%] cursor-pointer;
                }
                #account-menu {
                  @apply w-[350px] h-[300px] bg-purple-dark border border-[gainsboro] px-[10px] py-[15px] rounded-[30px] hidden shadow-lg absolute top-[80px] right-[30px] z-[1];
                  @media (max-width: 550px) {
                    @apply w-[300px] right-[20px];
                  }
                    .google {
                      @apply w-[100%] h-[100%] flex-col flex justify-between items-center;
                        .photo {
                          @apply w-[100px] h-[100px] rounded-[50%] opacity-70;
                        }
                        .hello {
                          @apply w-[80%] h-[30px] text-xl flex justify-center items-center;
                        }
                        .acc {
                          @apply w-[80%] h-[50px] flex flex-row justify-center;
                            .manage {
                              @apply w-[59.5%] h-[50px] flex justify-center items-center bg-grey-gray drop-shadow-md border border-grey rounded-l-[30px] hover:bg-white hover:drop-shadow-lg hover:font-semibold;
                            }
                            .log-out {
                              @apply w-[39.5%] h-[50px] border border-grey drop-shadow-md rounded-[30px] flex justify-center items-center bg-grey-gray hover:bg-white hover:drop-shadow-lg hover:font-semibold;
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
          @media (max-width: 560px) {
            @apply justify-start h-[30%];
          }
            .btn {
              @apply p-[10px] text-[16px] rounded-none;
            }
        }
    }
}

</style>

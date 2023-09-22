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
      },
    };
  },
};
</script>

<template>
  <section>
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
            <div class="topic shadow-lg w-[350px] absolute right-0 top-[107px] bg-white hidden">
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

                <div class="page-top">
                  <h4>頁首</h4>
                  <a class="choice-image">
                    <img :src="images.image" alt="">
                    <span>選擇圖片</span>
                  </a>
                </div>
                <div class="page-color">
                  <h4>顏色</h4>
                  <div class="colorbox-all">
                    <div class="col">
                      <div class="colorbox"><i class="fa-sharp fa-solid fa-check check"></i></div>
                      <div class="colorbox"><i class="fa-sharp fa-solid fa-check check"></i></div>
                      <div class="colorbox"><i class="fa-sharp fa-solid fa-check check"></i></div>
                      <div class="colorbox"><i class="fa-sharp fa-solid fa-check check"></i></div>
                      <div class="colorbox"><i class="fa-sharp fa-solid fa-check check"></i></div>
                      <div class="colorbox"><i class="fa-sharp fa-solid fa-check check"></i></div>
                    </div>
                    <div class="col">
                      <div class="colorbox"><i class="fa-sharp fa-solid fa-check check"></i></div>
                      <div class="colorbox"><i class="fa-sharp fa-solid fa-check check"></i></div>
                      <div class="colorbox"><i class="fa-sharp fa-solid fa-check check"></i></div>
                      <div class="colorbox"><i class="fa-sharp fa-solid fa-check check"></i></div>
                      <div class="colorbox"><i class="fa-sharp fa-solid fa-check check"></i></div>
                      <div class="colorbox"><i class="fa-sharp fa-solid fa-check check"></i></div>
                    </div>
                    <div class="col">
                      <div class="colorbox"><img class="add" :src="images.add"
                        alt=""></div>
                    </div>
                  </div>
                </div>

                <div class="page-background-color">
                  <h4>背景</h4>
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
                    <div class="colorbox border">
                      <i class="fa-sharp fa-solid fa-check check"></i>
                    </div>
                  </div>
                </div>

              </div>
            </div>
            <button type="button">
              <div class="eye w-[35px] h-[35px] flex justify-center items-center mx-[10px] pb-[4px]"><img :src="images.visibility" width="25" height="25" alt=""></div>
            </button>
            <button type="button" class="sent">傳送</button>
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
          <button type="button" class="btn">問題</button>
          <button type="button" class="btn">回覆</button>
          <button type="button" class="btn">設定</button>
        </div>
      </div>
    </nav>
  </section>
</template>

<style lang="scss" scoped>
#nav {
}

button {
    border: 0;
    background-color: white;
    cursor: pointer;
}

button:hover {
    background-color: rgb(237, 237, 237);
    border-radius: 50%;
}

.material-symbols-outlined {
    font-variation-settings:
        'FILL' 0,
        'wght' 400,
        'GRAD' 0,
        'opsz' 48,
}

nav {
  @apply relative;
    .container {
      @apply flex h-[107px] flex-col justify-between bg-[#ededed];
        .top {
          @apply bg-[#ededed];
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
                .eye {
                  @apply flex justify-center items-center mt-[5px];
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
                  @apply w-[400px] h-[400px] bg-[aliceblue] border border-[gainsboro] p-[5px] rounded-[30px] mt-[5px] hidden shadow-lg absolute top-[80px] right-[30px];
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
          @apply h-[40%] bg-[#ededed] flex justify-center items-end;
            .btn {
              @apply p-[10px] text-[16px] bg-[#ededed] rounded-none hover:bg-white active:bg-[#a287d156];
            }
        }
    }
}
.topic {
}

.topic-head {
  padding: 0 20px;
  width: 350px;
  display: flex;
  justify-content: space-between;
  box-shadow: 0 1px 1px 1px rgb(204, 204, 204);

  .top-text {
    padding: 15px 0;
    display: flex;
    align-content: center;

    .palette {
      width: 24px;
      margin-right: 10px;
    }
  }

  .close {
    padding: 15px;

    &:hover {
      border-radius: 50%;
      background-color: rgb(229, 229, 229);
    }

  }

  span {
    font-size: 22px;
    font-weight: 400;
    line-height: 24px;
  }
}

.topic-body {
  padding: 10px 20px;
  overflow-y: scroll;
  height: calc(100vh - 161px);

  .select-region {
    margin-bottom: 20px;

    .region-title {
      font-size: 18px;
      font-weight: 600;
      margin-bottom: 10px;
    }

    select {
      height: 50px;
      border-radius: 5px;
      border-color: rgb(215, 215, 215);
    }

    #font-family {
      width: 200px;
      margin-right: 8px;

      // &:hover {
      //   background-color: rgb(239, 239, 239);
      // }
    }

    #font-size {
      width: 80px;

      // &:hover {
      //   background-color: rgb(239, 239, 239);
      // }
    }
  }

  .page-top {
    .choice-image {
      width: 150px;
      display: flex;
      justify-content: center;
      border: 1px solid rgb(203, 203, 203);
      border-radius: 5px;
      padding: 10px 0;
      cursor: pointer;

      img {
        margin-right: 10px;
      }

      span {
        font-size: 20px;
        font-weight: 600;
        color: rgb(77, 146, 237);
      }
    }
  }
}

.col {
  display: flex;
  margin-bottom: 10px;

  .colorbox {
    display: flex;
    width: 30px;
    height: 30px;
    border-radius: 50%;
    margin-right: 10px;
    justify-content: center;
    align-content: center;

    &:hover {
      transform: scale(1.1);
      box-shadow: 0 1px 2px grey;
    }

    .check {
      padding: 7px 4px;
      width: 24px;
      display: none;
    }

    .add {
      width: 24px;
    }
  }
}
</style>

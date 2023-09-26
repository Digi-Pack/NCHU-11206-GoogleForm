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
      questions: [{
        question: '',
        id: 1,
      }],
      activeType: [
        {
          id: 3,
          indexs: 1,
        },
      ],
      alltype: 3,
    };
  },

  methods: {
    addques() {
      this.maxId++;
      const newQues = {
        question: '',
        id: this.maxId,
      };
      const textall = {
        id: 3,
        indexs: this.maxId,
      };
      this.questions.push(newQues);
      this.activeType.push(textall);
    },
    delQues(id) {
      console.log(id);
      const indexToDelete = this.questions.findIndex(question => question.id === id);
      //   console.log(this.questions);
      //   console.log(this.activeType);
      //   const typeToDelete = this.activeType.findIndex(item => item.indexs === id);

      if (indexToDelete !== -1) {
        // 找到匹配的问题区块索引后删除
        // this.activeType.splice(typeToDelete, 1);
        this.questions.splice(indexToDelete, 1);
      }
    },
    type1(id) {
      this.alltype = 1;
      if (id) {
        this.activeType[id - 1].id = this.alltype;
      }
    },
    type2(id) {
      this.alltype = 2;
      if (id) {
        this.activeType[id - 1].id = this.alltype;
      }
    },
    type3(id) {
      this.alltype = 3;
      if (id) {
        this.activeType[id - 1].id = this.alltype;
      }
    },
    type4(id) {
      this.alltype = 4;
      if (id) {
        this.activeType[id - 1].id = this.alltype;
      }
    },
    type5(id) {
      this.alltype = 5;
      if (id) {
        this.activeType[id - 1].id = this.alltype;
      }
    },
    type6(id) {
      this.alltype = 6;
      if (id) {
        this.activeType[id - 1].id = this.alltype;
      }
    },
    type7(id) {
      this.alltype = 7;
      if (id) {
        this.activeType[id - 1].id = this.alltype;
      }
    },
    type8(id) {
      this.alltype = 8;
      if (id) {
        this.activeType[id - 1].id = this.alltype;
      }
    },
    type9(id) {
      this.alltype = 9;
      if (id) {
        this.activeType[id - 1].id = this.alltype;
      }
    },
    type10(id) {
      this.alltype = 10;
      if (id) {
        this.activeType[id - 1].id = this.alltype;
      }
    },
    type11(id) {
      this.alltype = 11;
      if (id) {
        this.activeType[id - 1].id = this.alltype;
      }
    },
    test(el) {
      console.log(el);
    },
  },
};
</script>

<template>
  <section id="question">
    <div class="container">
      <!-- 側欄 -->
      <div class="side">
        <button type="button" class="side-func" @click="addques()">
          <img :src="add" alt="">
          <span>新增問題</span>
        </button>
        <div class="side-func">
          <img :src="upload" alt="">
          <span>匯入問題</span>
        </div>
        <div class="side-func">
          <img :src="text" alt="">
          <span>新增標題與說明</span>
        </div>
        <div class="side-func">
          <img :src="image" alt="">
          <span>新增圖片</span>
        </div>
        <div class="side-func">
          <img :src="video" alt="">
          <span>新增影片</span>
        </div>
        <div class="side-func">
          <img :src="view_agenda" alt="">
          <span>新增區段</span>
        </div>
      </div>
      <!-- 表單命名處 -->
      <div class="form-title">
        <!-- 表單名稱 -->
        <input type="text" value="未命名的表單" class="form-input form-title-input">
        <!-- 表單說明 -->
        <input type="text" value="表單說明" class="form-input form-explain-input-2">
      </div>
      <!-- 問題設置 -->
      <div v-for="question in questions" :key="question.id" class="question">
        <!-- 第一行 -->
        <div class="question-top">
          <div class="text-box">
            <span>{{ question.id }}.</span>
            <input type="text" value="問題" class="form-input form-title-input">
          </div>
          <img :src="image" alt="">
          <!-- 下拉選單 -->
          <div class="check">
            <label for="ques"></label>
            <select v-model="" class="answer-type" id="ques" name="">
              <option v-for="item in questionTypeOption" :key="item.id" :value="item.id">{{ item.name }}</option>
            </select>
            <!-- <div class="check-box">
              <img :src="radio_button" alt="">
              <span>選擇題</span>
              <img :src="arrow_down" alt="">
            </div> -->
          </div>
        </div>
        <!-- 第二行 第一種 簡答 -->
        <div v-if="activeType[question.id - 1].id === 1" class="questype-1 !block">
          <div class="short">簡答文字</div>

        </div>
        <!-- 第二行 第二種 詳答 -->
        <div v-if="activeType[question.id - 1].id === 2" class="questype-2 !block">
          <div class="long">詳答文字</div>

        </div>
        <!-- 第二行 第三種 選擇題 -->
        <div v-if="activeType[question.id - 1].id === 3" class="questype-3">
          <div class="choose">
            <input type="checkbox" id="checkbox">
            <label for="checkbox" class="checkbox"></label>
            <input type="text" class="choose_line" value="選項1">
          </div>

          <div class="choose">
            <input type="checkbox" id="checkbox2">
            <label for="checkbox2" class="checkbox"></label>
            <input type="text" class="choose_line choose_line2" value="新增選項">或&nbsp;<a href="">新增「其他」</a>
          </div>

        </div>
        <!-- 第二行 第四種 核取方塊 -->
        <div v-if="activeType[question.id - 1].id === 4" class="questype-4 !block">
          <div class="choose">
            <input type="checkbox" id="checkbox">
            <input type="text" class="choose_line" value="選項1">
          </div>

          <div class="choose">
            <input type="checkbox" id="checkbox2">
            <input type="text" class="choose_line choose_line2" value="新增選項">或&nbsp;<a href="">新增「其他」</a>
          </div>

        </div>
        <!-- 第二行 第五種 下拉式選單 -->
        <div v-if="activeType[question.id - 1].id === 5" class="questype-5 !block">
          <div class="choose">
            1<span>。</span><input type="text" class="choose_line" value="選項1">
          </div>

          <div class="choose">
            2<span>。</span><input type="text" class="choose_line choose_line2" value="新增選項">
          </div>

        </div>
        <!-- 第二行 第六種  檔案上傳 -->
        <div v-if="activeType[question.id - 1].id === 6" class="questype-6 !block">
          <h3>作答者可將檔案上傳到雲端硬碟</h3>
          <span>  檔案會上傳到表單擁有者的 Google 雲端硬碟。在表單中新增檔案上傳問題後，作答者必須登入 Google 才能回答問題。請務必只與你信任的對象共用這份表單。</span>
          <div><a href="">取消</a><a href="">繼續</a></div>

        </div>
        <!-- 第二行 第七種 線性刻度 -->
        <div v-if="activeType[question.id - 1].id === 7" class="questype-7 !block">
          <!-- 範圍設定 -->
          <div class="set-number">
            <ul class="number0-1">
              <li class="show-number"><span>0</span><i class="fa-solid fa-triangle fa-rotate-180"></i></li>
              <div class="choose0-1">
                <li>0</li>
                <li>1</li>
              </div>

            </ul>
            &nbsp;到&nbsp;
            <ul class="number2-10">
              <li class="show-number"><span>5</span><i class="fa-solid fa-triangle fa-rotate-180"></i></li>
              <div class="choose2-10">
                <li>2</li>
                <li>3</li>
                <li>4</li>
                <li>5</li>
                <li>6</li>
                <li>7</li>
                <li>8</li>
                <li>9</li>
                <li>10</li>
              </div>
            </ul>

          </div>
          <!-- 最大值與最小值意義設定 -->
          <div class="num-mean">
            <div class="min"><span class="min-num">1</span><input type="text" class="num-mean-input" value="標籤(選填)"></div>

            <div class="max"><span class="max-num">5</span><input type="text" class="num-mean-input" value="標籤(選填)"></div>

          </div>
        </div>
        <!-- 第二行 第八種  單選方格 -->
        <div v-if="activeType[question.id - 1].id === 8" class="questype-8 !block">
          <div class="left_right">
            <div class="left">
              <div>列</div>

              <div class="choose">
                1<span>。</span><input type="text" class="choose_line" value="選項1">
              </div>

              <div class="choose">
                2<span>。</span><input type="text" class="choose_line choose_line2" value="新增列">
              </div>

            </div>
            <div class="right">
              <div>欄</div>

              <div class="choose">
                <input type="checkbox" id="checkbox">
                <label for="checkbox" class="checkbox"></label>
                <input type="text" class="choose_line" value="選項1">
              </div>

              <div class="choose">
                <input type="checkbox" id="checkbox2">
                <label for="checkbox2" class="checkbox"></label>
                <input type="text" class="choose_line choose_line2" value="新增欄">
              </div>

            </div>
          </div>
        </div>
        <!-- 第二行 第九種  核取方塊格 -->
        <div v-if="activeType[question.id - 1].id === 9" class="questype-9 !block">
          <div class="left_right">
            <div class="left">
              <div>列</div>

              <div class="choose">
                1<span>。</span><input type="text" class="choose_line" value="第1列">
              </div>

              <div class="choose">
                2<span>。</span><input type="text" class="choose_line choose_line2" value="新增列">
              </div>

            </div>
            <div class="right">
              <div>欄</div>

              <div class="choose">
                <input type="checkbox" id="checkbox">
                <label for="checkbox" class="checkbox"></label>
                <input type="text" class="choose_line" value="第1欄">
              </div>

              <div class="choose">
                <input type="checkbox" id="checkbox2">
                <label for="checkbox2" class="checkbox"></label>
                <input type="text" class="choose_line choose_line2" value="新增欄">
              </div>

            </div>
          </div>
        </div>
        <!-- 第二行 第十種  日期 -->
        <div v-if="activeType[question.id - 1].id === 10" class="questype-10 !block">
          <div class="calender">年/月/日<i class="fa-regular fa-calendar-day"></i></div>

        </div>
        <!-- 第二行 第十一種  時間 -->
        <div v-if="activeType[question.id - 1].id === 11" class="questype-11 !block">
          <div class="clock">時間<i class="fa-regular fa-clock"></i></div>

        </div>
        <!-- 第三行 -->
        <div class="question-bottom">
          <div class="func">
            <img :src="copy" alt="">
            <button type="button" @click="delQues(question.id)"><img :src="del" alt=""></button>
          </div>

          <!-- 必填選項開關 -->
          <div class="switch">
            <label>
              <span class="text">必填</span>
              <input type="checkbox" name="" id="" class="checkbox">
              <span class="btn-box">
                <span class="btn"></span>
              </span>
            </label>
          </div>
        </div>
      </div>
    </div>
  </section>
</template>

<style lang="scss" scoped>
#question {
    $grey:rgb(178, 176, 176);
    $font-grey:rgb(108, 105, 105);
    $grey-bac:rgb(104,108,113);
    $blue:rgb(237,244,253);
    $md-blue:rgb(39,123,233);

.container{
    @apply max-w-[770px] m-auto relative mt-[20px];
    .side{
        @apply w-[49px] h-[253px] flex flex-col absolute top-0 -right-[70px] bg-white rounded-[10px] shadow tablet:fixed tablet:flex-row tablet:justify-around tablet:h-[60px] tablet:w-[98%] tablet:top-[calc(100%-60px)] tablet:left-0;

        img {
            @apply w-[22px];
        }

        .side-func {
            @apply flex justify-center items-center relative py-[10px] hover:bg-blue-light;
            &:hover span{
                @apply block;
            }
            &:nth-of-type(1){
                @apply rounded-tl-[10px] rounded-tr-[10px];
            }
            &:nth-of-type(6){
                @apply rounded-bl-[10px] rounded-br-[10px];
            }
            span{
                @apply hidden absolute w-auto whitespace-nowrap p-[6px] bg-gray-500 text-white text-xs rounded-[3px] top-[10px] left-[60px];
            }
        }
    }

    .form-title{
        @apply w-full rounded-[10px] border-t-[10px] border-l-[10px] border-l-purple border-t-purple pt-[22px] pb-[24px];
        .form-input {
            @apply border-x-0 border-t-0 border-b-gray-400 w-[91%] font-semibold my-2 mx-[25px] focus:border-b-[3px] focus:border-b-purple focus:outline-none;
        }
        .form-title-input{
            @apply  h-[45px] text-[32px] ;
        }
        .form-explain-input-2{
            @apply h-[21px] text-[18px] text-grey;
        }
    }

    .question {
        @apply rounded-[10px] border-l-[10px] border-l-purple p-[24px] my-[12px];
        img {
            @apply w-[22px];
        }
        .question-top {
            @apply flex flex-wrap justify-between items-center;
            // @media(max-width:435px){
            //     justify-content:initial;
            // }
            .text-box {
                @apply w-[447px] mt-[10px];

                @media(max-width:770px){
                    width:90%;
                }
                @media(max-width:435px){
                    width:100%;
                }

                .form-title-input {
                    @apply border-x-0 border-t-0 border-b-gray-400 w-full h-[56px] text-base font-semibold focus:bg-gray-50 focus:border-b-[3px] focus:border-b-purple focus:outline-none rounded-tl-[10px] rounded-tr-[10px];
                }
            }
            .check {
                @apply relative mt-[10px];

                @media(max-width:435px){
                    margin-left: 10px;
                }
                .check-box {
                    @apply flex justify-around items-center w-[209px] h-[49px] rounded-[10px] text-gray-500 font-semibold border border-grey;
                }
                .answer-type {
                    @apply w-[209px] max-h-[380px] border border-grey rounded-[10px] overflow-y-scroll;
                    ul {
                        @apply w-full border-x-0 border-t-0 bg-white border border-b-gray-400 px-[3px] py-[8px] m-0;
                        button {
                            @apply w-full flex h-[48px] p-[8px] font-normal hover:bg-blue;
                            img {
                                @apply mr-[26px] w-[22px] h-[22px] inline-block;
                            }
                        }
                    }
                }
            }
        }
        .questype-1{
            padding: 20px 0 35px ;
            display: none;
            border-bottom: 1px solid $grey;
            .short{
            width:60%;
            font-size: 16px;
            font-weight:600;
            color:$grey;
            border-bottom:1px dotted $grey;
            }
        }
        .questype-2{
            padding: 20px 0 35px;
            display:none;
            border-bottom: 1px solid $grey;
            .long{
            width:85%;
            font-size: 16px;
            font-weight:600;
            color:$grey;
            border-bottom:1px dotted $grey;
            }
        }
        .questype-3{
            width:100%;
            padding: 30px 0;
            border-bottom: 1px solid $grey;
            .choose{
                width:100%;
                display: flex;
                align-items: center;
                #checkbox, #checkbox2{
                    display: none;
                }
                .checkbox{
                    width:24px;
                    height:24px;
                    display: inline-block;
                    border-radius: 50%;
                    border:2px solid $grey;
                    margin-right: 5px;

                }
                .choose_line{
                    width:80%;
                    border:none;
                    height:40px;
                    font-size:16px;
                    font-weight: 500;
                    &:hover{
                        border-bottom:1px solid $grey ;
                    }
                    &:focus{
                        border:0px solid white;
                        border-bottom:3px solid  rgb(103,58,183);
                        outline: none;
                    }

                }
                .choose_line2{
                        width:70px;
                        color:$font-grey;

                }
                a{
                    color:$md-blue;
                    text-decoration: none;
                }
            }
        }
        .questype-4{
            width:100%;
            padding: 30px 0;
            border-bottom: 1px solid $grey;
            display:none;
            .choose{
                width:100%;
                display: flex;
                align-items: center;
                #checkbox, #checkbox2{
                   width:24px;
                   height:24px;
                //    border-radius: 4px;
                //    border:5px solid $grey;
                   margin-right: 5px;
                   pointer-events: none;
                }
                .choose_line{
                    width:80%;
                    border:none;
                    height:40px;
                    font-size:16px;
                    font-weight: 500;
                    &:hover{
                        border-bottom:1px solid $grey ;
                    }
                    &:focus{
                        border:0px solid white;
                        border-bottom:3px solid  rgb(103,58,183);
                        outline: none;
                    }

                }
                .choose_line2{
                        width:70px;
                        color:$font-grey;

                }
                a{
                    color:$md-blue;
                    text-decoration: none;
                }
            }
        }
        .questype-5{
            display:none;
            width:100%;
            padding: 30px 0;
            border-bottom: 1px solid $grey;
            display:none;
            .choose{
                width:100%;
                display: flex;
                align-items: center;
                span{
                    padding-top: 12px;
                }
                .choose_line{
                    width:80%;
                    border:none;
                    height:40px;
                    font-size:16px;
                    font-weight: 500;
                    &:hover{
                        border-bottom:1px solid $grey ;
                    }
                    &:focus{
                        border:0px solid white;
                        border-bottom:3px solid  rgb(103,58,183);
                        outline: none;
                    }
                }
                .choose_line2{
                        width:70px;
                        color:$font-grey;
                }
            }
        }
        .questype-6{
            width:100%;
            display: none;
            padding: 10px 0 10px;
            div{
                padding:20px;
                width:100%;
                display: flex;
                justify-content: end;
                a{
                    color:$md-blue;
                    text-decoration: none;
                }
            }
        }
        .questype-7{
           width:100%;
           border-bottom: 1px solid $grey;
           padding-bottom: 30px;
           display:none;
            .set-number{
                display: flex;
                align-items: center;
                 ul{
                    width:70px;
                    // background-color: aquamarine;
                    padding:10px 0px;
                    margin: 0px;
                    border-radius: 10px;
                    position: relative;
                        li{
                            width:70px;
                            display: block;
                            height: 50px;
                            line-height: 50px;
                            text-align: center;
                            display: none;
                            color:$font-grey;
                            padding: 0 5px 0 10px;
                            i{
                                font-size: 5px;
                                margin-left: 26px;
                                }
                            &:hover{
                                background-color: $blue;

                                }
                        }
                        .choose0-1, .choose2-10{
                            width:70px;
                            background-color:white;
                            display:none;
                            padding:5px 0;
                            border-radius:10px;
                            // background-color:blue;
                            box-shadow:3px 3px 3px $grey;
                            box-shadow:0px 0px 3px $grey;
                            position:absolute;
                            bottom:0;
                        }
                        .show-number{
                            display: block;
                            }
                    }

                }
           .num-mean{
                color:$grey;
                font-size: 16px;
                font-weight: 600;
            }
            .num-mean-input{
                border:none;
                border-bottom:1px solid $grey ;
                width:200px;
                height:40px;
                font-size:16px;
                font-weight: 600;
                margin:8px 25px 8px;
                color:$grey;
                &:focus{
                    border:0px solid white;
                    border-bottom:3px solid  rgb(103,58,183);
                    outline: none;
                }
            }
        }
        .questype-8{
            width:100%;
            display: none;
            .left_right{
                width:100%;
             .right, .left{
                width:50%;
                padding: 30px 0;
                border-bottom: 1px solid $grey;
                .choose{
                    width:100%;
                    display: flex;
                    align-items: center;
                    span{
                        padding-top: 12px;
                    }
                    .choose_line{
                        width:80%;
                        border:none;
                        height:40px;
                        font-size:16px;
                        font-weight: 500;
                        &:hover{
                            border-bottom:1px solid $grey ;
                        }
                        &:focus{
                            border:0px solid white;
                            border-bottom:3px solid  rgb(103,58,183);
                            outline: none;
                        }
                    }
                    .choose_line2{
                            width:70px;
                            color:$font-grey;
                    }
                }
             }
             .right{
                #checkbox, #checkbox2{
                    width:24px;
                    height:24px;
                    margin-right: 5px;
                    pointer-events: none;
                 }

             }
            }
        }
        .questype-9{
            width:100%;
            display: none;
            .left_right{
                width:100%;
             .right, .left{
                width:50%;
                padding: 30px 0;
                border-bottom: 1px solid $grey;
                .choose{
                    width:100%;
                    display: flex;
                    align-items: center;
                    span{
                        padding-top: 12px;
                    }
                    .choose_line{
                        width:80%;
                        border:none;
                        height:40px;
                        font-size:16px;
                        font-weight: 500;
                        &:hover{
                            border-bottom:1px solid $grey ;
                        }
                        &:focus{
                            border:0px solid white;
                            border-bottom:3px solid  rgb(103,58,183);
                            outline: none;
                        }
                    }
                    .choose_line2{
                            width:70px;
                            color:$font-grey;
                    }
                }
             }
             .right{
                #checkbox, #checkbox2{
                    width:24px;
                    height:24px;
                    margin-right: 5px;
                    pointer-events: none;
                 }

             }
            }
        }
        .questype-10{
            padding: 20px 0 35px ;
            display:none;
            border-bottom: 1px solid $grey;
            .calender{
                display:flex;
                justify-content: space-between;
                width:35%;
                font-size: 16px;
                font-weight:600;
                color:$grey;
                border-bottom:1px dotted $grey;
            }
        }
        .questype-11{
          @apply pt-[20px] pb-[35px] hidden border-b border-grey;
            .clock{
                display:flex;
                justify-content: space-between;
                width:35%;
                font-size: 16px;
                font-weight:600;
                color:$grey;
                border-bottom:1px dotted $grey;
            }
        }
        .question-bottom {
            @apply w-full flex justify-end items-center text-lg font-semibold text-grey pt-[0px] pr-[10px];
            .func{
                @apply w-full h-[52px] pr-5 flex items-center justify-end border-r border-r-gray-400;
                img {
                  @apply w-[22px] h-[22px] mr-2.5;
                }
                @media(max-width:480px){
                    display:none;
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
                .checkbox:checked + .btn-box {
                    @apply bg-blue;
                }
                .checkbox:checked + .btn-box .btn {
                    @apply ml-[20px];
                }
            }
        }
    }
}
}
</style>


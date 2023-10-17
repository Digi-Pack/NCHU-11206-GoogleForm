<script>
import excel from '/resources/images/excel.png';
import dot from '/resources/images/dot.png';
import image from '/resources/images/image.png';
import download from '/resources/images/download.png';
import print from '/resources/images/print.png';
import del from '/resources/images/del.png';
import check from '/resources/images/check.png';
import linkoff from '/resources/images/link_off.png';
import chevron_left from '/resources/images/chevron_left.svg';
import chevron_right from '/resources/images/chevron_right.svg';
import { router } from '@inertiajs/vue3';
import Swal from 'sweetalert2';

export default {
  props: {
    response: {
      type: Object,
      required: false,
      default: () => ({}),
    },
  },
  data() {
    return {
      excel: excel,
      dot: dot,
      image: image,
      download: download,
      print: print,
      del: del,
      check: check,
      linkoff: linkoff,
      chevron_left: chevron_left,
      chevron_right: chevron_right,
      num: 1,
      coFormId: route()?.params?.id ?? '0',
      queform: {
        que: this.response?.rt_data?.results ?? [],
      },
    };
  },
  computed: {
    formStringJson() {
      const { queform: { que } } = this;
      return JSON.parse(que?.questionnaires ?? '[]');
    },
    ansStringJson() {
      const { response: { rt_data } } = this;
      return JSON.parse(rt_data?.fillform?.answer ?? '[]');
    },
  },
  methods: {
    currentUrl(urlName = '') {
      if (urlName === '') return;
      return route().current(urlName);
    },
    minus() {
      if (this.num === 1) return;
      this.num--;
      const { num, coFormId } = this;
      router.visit(route('response.ind', { id: coFormId }), {
        method: 'get', data: { num }, preserveState: true,
      });
    },
    plus() {
      const { response } = this;
      if (response.rt_data.results.response_count > this.num) {
        this.num++;
        const { num, coFormId } = this;
        router.visit(route('response.ind', { id: coFormId }), {
          method: 'get', data: { num }, preserveState: true,
        });
      }
    },
    arrayData(min, max) {
      let loopResult = [];
      for (let i = min; i <= max; i++) {
        loopResult.push(i);
      }
      return loopResult;
    },
    ansDelete() {
      const { num, coFormId } = this;
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
          router.visit(route('response.delete'), {
            method: 'delete', data: { num, coFormId }, preserveState: true,
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
    },
  },
};
</script>

<template>
  <section id="response" class="pt-[10px]">
    <div class="all">
      <div class="response-head bg-white">
        <div class="head-top">
          <h2 class="text-[28px] pb-10 font-bold">{{ response.rt_data.results.response_count }} 則回應</h2>
        </div>
        <div class="head-middle">
          <NavLink class="btn" :href="route('response.sum', { id: coFormId })" :active="currentUrl('response.sum')">
            摘要
          </NavLink>
          <NavLink class="btn" :href="route('response.que', { id: coFormId })" :active="currentUrl('response.que')">
            問題
          </NavLink>
          <NavLink class="btn" :href="route('response.ind', { id: coFormId })" :active="currentUrl('response.ind')">
            個別
          </NavLink>
        </div>
        <div class="head-fotter">
          <div class="flex ml-3">
            <button type="button" @click="minus()"><img :src="chevron_left" alt="" class="select-btn"></button>
            <div>第
              <input v-if="response.rt_data.results.response_count === 0" type="number" :value="num - 1"
                class="border-x-0 border-t-0 border-gray-200 border-[3px] w-[60px] focus:ring-0 focus:border-purple">
              <input v-else type="number" :value="num"
                class="border-x-0 border-t-0 border-gray-200 border-[3px] w-[60px] focus:ring-0 focus:border-purple">
              項, 共
              {{ response.rt_data.results.response_count }}
              項
            </div>
            <button type="button" @click="plus()"><img :src="chevron_right" alt="" class="select-btn"></button>
          </div>
          <button v-if="response.rt_data.results.response_count !== 0" type="button" @click="ansDelete()">
            <label>
              <img :src="del" alt="" class="select-btn">
            </label>
          </button>
        </div>
      </div>
      <div class="response-body">
        <div v-if="response.rt_data.results.response_count === 0" class="response">
          待回應
        </div>
        <div v-else class="container">
          <div class="form-title">
            <!-- 表單名稱 -->
            <input v-model="queform.que.qu_naires_title" type="text" class="form-input form-title-input truncate"
              disabled>
            <!-- 表單說明 -->
            <input v-model="queform.que.qu_naires_desc" type="text" class="form-input form-explain-input-2 truncate"
              disabled>
          </div>
          <div v-for="(item, key) in formStringJson" :key="item.id" class="question">
            <!-- 簡答 -->
            <div>
              <img v-if="item.image" :src="item.image" class="w-[200px] aspect-[4/3] object-cover" alt="">
            </div>
            <div v-if="item.type === 1" class="!block">
              <span class="text-[18px]">{{ item.title }}</span>
              <div v-if="ansStringJson[key]" class="questype-1 w-1/2 border-b-black border-b border-dotted">
                {{ ansStringJson[key].answer }}
              </div>
            </div>
            <!-- 詳答 -->
            <div v-if="item.type === 2" class="!block">
              <span class="text-[18px]">{{ item.title }}</span>
              <div v-if="ansStringJson[key]" class="questype-2 border-b-black border-b border-dotted">
                {{ ansStringJson[key].answer }}
              </div>
            </div>
            <!-- 選擇題 -->
            <div v-if="item.type === 3">
              <span class="text-[18px]">{{ item.title }}</span>
              <div class="questype-3">
                <div v-if="!ansStringJson[key]">
                  <div v-for="choose in item.options" :key="choose.id" class="option my-3">
                    <input type="radio" class="choice-1 mr-3 text-grey"
                      :value="choose.id" disabled>
                    <label for="choice-1 w-full truncate">{{ choose.value }}</label>
                  </div>
                </div>
                <div v-if="ansStringJson[key]">
                  <div v-for="choose in item.options" :key="choose.id" class="option my-3">
                    <input v-model="ansStringJson[key].answer" type="radio" class="choice-1 mr-3 text-grey"
                      :value="choose.id" disabled>
                    <label for="choice-1 w-full truncate">{{ choose.value }}</label>
                  </div>
                </div>
              </div>
            </div>
            <!-- 核取方塊 -->
            <div v-if="item.type === 4" class="!block">
              <span class="text-[18px]">{{ item.title }}</span>
              <div v-if="!ansStringJson[key]">
                <div class="questype-4">
                  <div v-for="choose in item.options" :key="choose.id" class="option my-3">
                    <input type="checkbox" class="focus mr-3 text-grey"
                      :value="choose.id" disabled>
                    <label for="focus w-full truncate">{{ choose.value }}</label>
                  </div>
                </div>
              </div>
              <div v-if="ansStringJson[key]">
                <div class="questype-4">
                  <div v-for="choose in item.options" :key="choose.id" class="option my-3">
                    <input v-model="ansStringJson[key].manyOptions" type="checkbox" class="focus mr-3 text-grey"
                      :value="choose.id" disabled>
                    <label for="focus w-full truncate">{{ choose.value }}</label>
                  </div>
                </div>
              </div>
            </div>
            <!-- 下拉式選單 -->
            <div v-if="item.type === 5" class="!block">
              <span class="text-[18px]">{{ item.title }}</span>
              <div v-if="!ansStringJson[key]">
                <div class="questype-5 mt-5">
                  <label for="select"></label>
                  <select name="select" id="select"
                    class="border-grey-dark rounded-md w-[200px] py-3">
                    <option v-for="choose in item.options" :key="choose.id" :value="choose.id" disabled>{{ choose.value
                    }}
                    </option>
                  </select>
                </div>
              </div>
              <div v-if="ansStringJson[key]">
                <div class="questype-5 mt-5">
                  <label for="select"></label>
                  <select v-model="ansStringJson[key].answer" name="select" id="select"
                    class="border-grey-dark rounded-md w-[200px] py-3">
                    <option v-for="choose in item.options" :key="choose.id" :value="choose.id" disabled>{{ choose.value
                    }}
                    </option>
                  </select>
                </div>
              </div>
            </div>
            <!-- 檔案上傳 -->
            <div v-if="item.type === 6" class="!block">
              <span class="text-[18px]">{{ item.title }}</span>
              <div v-if="!ansStringJson[key]">
                <div
                  class="questype-6 border-[2px] mt-2 border-grey rounded-md w-1/2 hover:border-gray-600 active:hover:border-white active:bg-grey-dark">
                  <div class="flex items-center gap-2 px-2 py-1">
                    <img :src="image" alt="">
                    <span class="truncate !text-gray-800"></span>
                  </div>
                </div>
              </div>
              <div v-if="ansStringJson[key]">
                <div
                  class="questype-6 border-[2px] mt-2 border-grey rounded-md w-1/2 hover:border-gray-600 active:hover:border-white active:bg-grey-dark">
                  <a :href="ansStringJson[key].file.path" :download="ansStringJson[key].file.name"
                    class="flex items-center gap-2 px-2 py-1">
                    <img :src="image" alt="">
                    <span class="truncate !text-gray-800">{{ ansStringJson[key].file.name }}</span>
                  </a>
                </div>
              </div>
            </div>
            <!-- 線性刻度 -->
            <div v-if="item.type === 7" class="!block">
              <span class="text-[18px] w-[120px] truncate">{{ item.title }}</span>
              <div v-if="!ansStringJson[key]" class="questype-7 flex justify-center items-center gap-6 my-10">
                <span class="w-[120px] flex justify-end pt-12 truncate">{{ item.linear.minText }}</span>
                <div v-for="(i, index) in arrayData(parseInt(item.linear.min), parseInt(item.linear.max))" :key=index
                  class="flex flex-col items-center gap-5">
                  <label> {{ i }}
                  </label>
                  <input type="radio" class="text-grey p-3" :value="i" disabled>
                </div>

                <span class="w-[120px] truncate pt-12">{{ item.linear.maxText }}</span>
              </div>
              <div v-if="ansStringJson[key]" class="questype-7 flex justify-center items-center gap-6 my-10">
                <span class="w-[120px] flex justify-end pt-12 truncate">{{ item.linear.minText }}</span>
                <div v-for="(i, index) in arrayData(parseInt(item.linear.min), parseInt(item.linear.max))" :key=index
                  class="flex flex-col items-center gap-5">
                  <label> {{ i }}
                  </label>
                  <input v-model="ansStringJson[key].manyOptions" type="radio" class="text-grey p-3" :value="i" disabled>
                </div>
                <span class="w-[120px] truncate pt-12">{{ item.linear.maxText }}</span>
              </div>
            </div>
            <!-- 單選方格 -->
            <div v-if="item.type === 8" class="!block">
              <span class="text-[18px]">{{ item.title }}</span>
              <div class="questype-8">
                <table v-if="!ansStringJson[key]" class="w-full table-fixed border-separate border-spacing-y-2">
                  <thead>
                    <tr>
                      <th></th>
                      <th v-for="choose in item.square.column" :key="choose.id" class="truncate">{{ choose.text }}</th>
                    </tr>
                  </thead>
                  <tbody>

                    <tr v-for="(choose, innerkey) in item.square.row" :key="choose.id" class="bg-purple-light">
                      <th class="truncate">{{ choose.text }}</th>
                      <td v-for="(choosecol, innerinnerkey) in item.square.column" :key="choosecol.id"
                        class="text-center py-4">
                        <input class="text-grey" type="radio"
                          :name="'only-' + key + innerkey" :value="'row' + (innerkey + 1) + 'col' + (innerinnerkey + 1)"
                          disabled>
                      </td>
                    </tr>

                  </tbody>
                </table>
                <table v-if="ansStringJson[key]" class="w-full table-fixed border-separate border-spacing-y-2">
                  <thead>
                    <tr>
                      <th></th>
                      <th v-for="choose in item.square.column" :key="choose.id" class="truncate">{{ choose.text }}</th>
                    </tr>
                  </thead>
                  <tbody>

                    <tr v-for="(choose, innerkey) in item.square.row" :key="choose.id" class="bg-purple-light">
                      <th class="truncate">{{ choose.text }}</th>
                      <td v-for="(choosecol, innerinnerkey) in item.square.column" :key="choosecol.id"
                        class="text-center py-4">
                        <input v-model="ansStringJson[key].manyOptions[innerkey]" class="text-grey" type="radio"
                          :name="'only-' + key + innerkey" :value="'row' + (innerkey + 1) + 'col' + (innerinnerkey + 1)"
                          disabled>
                      </td>
                    </tr>

                  </tbody>
                </table>
              </div>
            </div>
            <!-- 核取方塊格 -->
            <div v-if="item.type === 9" class="!block">
              <span class="text-[18px]">{{ item.title }}</span>
              <div v-if="!ansStringJson[key]" class="questype-9 w-full">
                <table class="w-full table-fixed border-separate border-spacing-y-2">
                  <thead>
                    <tr>
                      <th></th>
                      <th v-for="choose in item.square.column" :key="choose.id" class="truncate">{{ choose.text }}</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr v-for="(choose, innerkey) in item.square.row" :key="choose.id" class="bg-purple-light">
                      <th class="truncate">{{ choose.text }}</th>
                      <td v-for="(choosecol, innerinnerkey) in item.square.column" :key="choosecol.id"
                        class="text-center py-4">
                        <input class="text-grey" type="checkbox"
                          :name="'many-' + innerkey + '-' + innerinnerkey"
                          :value="'row' + (innerkey + 1) + 'col' + (innerinnerkey + 1)" disabled>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
              <div v-if="ansStringJson[key]" class="questype-9 w-full">
                <table class="w-full table-fixed border-separate border-spacing-y-2">
                  <thead>
                    <tr>
                      <th></th>
                      <th v-for="choose in item.square.column" :key="choose.id" class="truncate">{{ choose.text }}</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr v-for="(choose, innerkey) in item.square.row" :key="choose.id" class="bg-purple-light">
                      <th class="truncate">{{ choose.text }}</th>
                      <td v-for="(choosecol, innerinnerkey) in item.square.column" :key="choosecol.id"
                        class="text-center py-4">
                        <input v-model="ansStringJson[key].manyOptions" class="text-grey" type="checkbox"
                          :name="'many-' + innerkey + '-' + innerinnerkey"
                          :value="'row' + (innerkey + 1) + 'col' + (innerinnerkey + 1)" disabled>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
            <!-- 日期 -->
            <div v-if="item.type === 10" class="!block">
              <span class="text-[18px]">{{ item.title }}</span>
              <div v-if="!ansStringJson[key]" class="questype-10 flex flex-col">
                <div class="text-grey text-sm tracking-widest">YYYY MM DD</div>
                <input type="date" class="border-0 pl-0 tracking-wider" disabled>
              </div>
              <div v-if="ansStringJson[key]" class="questype-10 flex flex-col">
                <div class="text-grey text-sm tracking-widest">YYYY MM DD</div>
                <input v-model="ansStringJson[key].answer" type="date" class="border-0 pl-0 tracking-wider" disabled>
              </div>

            </div>
            <!-- 時間 -->
            <div v-if="item.type === 11" class="!block">
              <span class="text-[18px]">{{ item.title }}</span>
              <div v-if="!ansStringJson[key]" class="questype-11 flex justify-start items-center">
                <input type="text" class="border-0 border-b border-dotted w-[17px] p-0 mx-2"
                  disabled>
                <span>:</span>
                <input type="text" class="border-0 border-b border-dotted w-[17px] p-0 mx-2"
                  disabled>
                <select name="" id="" class="border-0">
                  <option value="a.m." disabled>上午</option>
                  <option value="p.m." disabled>下午</option>
                </select>
              </div>
              <div v-if="ansStringJson[key]" class="questype-11 flex justify-start items-center">
                <input type="text" class="border-0 border-b border-dotted w-[17px] p-0 mx-2"
                  v-model="ansStringJson[key].time.hour" disabled>
                <span>:</span>
                <input type="text" class="border-0 border-b border-dotted w-[17px] p-0 mx-2"
                  v-model="ansStringJson[key].time.minute" disabled>
                <select name="" id="" class="border-0" v-model="ansStringJson[key].time.section">
                  <option value="a.m." disabled>上午</option>
                  <option value="p.m." disabled>下午</option>
                </select>
              </div>
            </div>
            <!-- 影片 -->
            <div v-if="item.type === 13" class="!block">
              <div class="p-5 flex justify-center">
                <iframe class="max-w-[600px] w-[90%] h-[400px]" :src="item.video" title="YouTube video player"
                  frameborder="0" allowfullscreen></iframe>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</template>

<style lang="scss" scoped>
#response {
  @apply min-h-[100vh] mt-[20px] pb-[20px];

  .all {
    @apply m-auto max-w-[770px] relative z-[2];

    .response-head {
      @apply my-[15px] rounded-[10px] border border-gray-200;

      .head-top {
        @apply pt-[16px] pr-[8px] ps-[24px] flex justify-between items-center;
      }

      .head-middle {
        @apply flex justify-around h-[50px] border-b;

        .btn {
          @apply p-[10px] text-[16px] focus:bg-purple-light;
        }
      }

      .head-fotter {
        @apply h-[150px] p-5 flex items-center justify-between;

        .select-btn {
          @apply w-[50px] h-[50px] p-3 hover:bg-grey-light rounded-[50%];
        }
      }
    }

    .response-body {
      @apply flex min-h-[80px] justify-center items-center rounded-[10px];

      .response {
        @apply w-full rounded-[10px] border py-[22px] bg-white flex justify-center items-center text-[#686868] min-h-[80px];
      }

      .form-title {
        @apply max-w-[770px] rounded-[10px] border-t-[10px] border-t-purple pt-[22px] pb-[24px] bg-white;

        .form-input {
          @apply border-x-0 border-t-0 border-b-gray-400 w-[91%] font-semibold my-2 mx-[25px] focus:border-b-[3px] focus:border-b-purple focus:ring-0;
        }

        .form-title-input {
          @apply h-[45px] text-[32px];
        }

        .form-explain-input-2 {
          @apply h-[21px] text-[18px] text-grey;
        }
      }

      .question {
        @apply rounded-[10px] p-[24px] my-[12px] bg-white;

        .questype-7 {
          @media (max-width: 690px) {
            @apply flex-col items-start pl-5;
          }

          span {
            @media (max-width: 690px) {
              @apply justify-start;
            }
          }
        }
      }

      span {
        @apply text-[#686868];
      }
    }
  }
}</style>


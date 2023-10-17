<script>
import excel from '/resources/images/excel.png';
import dot from '/resources/images/dot.png';
import download from '/resources/images/download.png';
import print from '/resources/images/print.png';
import del from '/resources/images/del.png';
import check from '/resources/images/check.png';
import chevron_left from '/resources/images/chevron_left.svg';
import chevron_right from '/resources/images/chevron_right.svg';
import linkoff from '/resources/images/link_off.png';
import FindAns from '@/Components/Modal/FindAns.vue';

export default {
  components: {
    FindAns,
  },
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
      download: download,
      print: print,
      del: del,
      check: check,
      linkoff: linkoff,
      chevron_left: chevron_left,
      chevron_right: chevron_right,
      num: 1,
      coFormId: route()?.params?.id ?? '0',
      titles: 1,
    };
  },
  computed: {
    formStringJson() {
      const { response: { rt_data } } = this;
      return JSON.parse(rt_data?.results?.questionnaires ?? '[]');
    },
    ansStringJson() {
      const { response: { rt_data } } = this;
      return rt_data.results.response.map(item => {
        return JSON.parse(item?.answer ?? '[]');
      });
    },
    findAns() {
      const { ansStringJson, formStringJson, titles } = this;
      return ansStringJson.map((item, index) => {
        return {
          id: index + 1,
          ans: item.find(ans => parseInt(ans.id) === parseInt(titles)),
          qus: formStringJson.find(qus => qus.id === titles),
        };
      });
    },
  },
  mounted() {
  },
  methods: {
    currentUrl(urlName = '') {
      if (urlName === '') return;
      return route().current(urlName);
    },
    minus() {
      if (this.num === 1) return;
      this.num--;
      this.titles = this.num;
    },
    plus() {
      if (this.formStringJson.length > this.num) {
        this.num++;
        this.titles = this.num;
      }
    },
  },
};
</script>

<template>
  <section id="response" class="pt-[10px]">
    <div class="all">
      <div class="response-head bg-white">
        <div class="head-top">
          <h2 class="text-[28px] pb-10 font-bold">{{ response?.rt_data?.responseFormReply?.response_count ?? '' }} 則回應
          </h2>
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
          <select v-model="titles" name="" id="">
            <option v-for="item in response?.rt_data?.responseForm ?? []" :key="item.id" :value="item.id">
              {{ item.title }}
            </option>
          </select>
          <div class="flex ml-3">
            <button type="button" @click="minus()"><img :src="chevron_left" alt="" class="select-btn"></button>
            <div>第
              <input type="number" :value="num"
                class="border-x-0 border-t-0 border-gray-200 border-[3px] w-[60px] focus:ring-0 focus:border-purple">項, 共
              {{ formStringJson?.length ?? '' }} 項
            </div>
            <button type="button" @click="plus()"><img :src="chevron_right" alt="" class="select-btn"></button>
          </div>
        </div>
      </div>
      <div v-if="response?.rt_data?.responseFormReply?.response_count ?? false" class="response-body">
        <div v-for="que in response?.rt_data?.responseForm ?? []" :key="que.id">
          <div>
            <div v-if="que.id === titles" class="responser">
              {{ que.title }}
              <div>
                <img v-if="que.image" :src="que.image" class="w-[200px] aspect-[4/3] object-cover" alt="">
              </div>
              <div v-for="option in que.options" :key="option.id">
                <div class="my-2">
                  <input v-if="que.type === 3" type="radio" class="m-3" disabled>
                  <input v-if="que.type === 4" type="checkbox" class="m-3" disabled>
                  <span v-if="que.type === 5" class="m-3 text-base" disabled>{{ option.id }}。</span>
                  <span v-if="option.value" class="text-[16px]">{{ option.value }}</span>
                </div>
              </div>
              <div v-if="que.type === 8">
                <table class="w-full table-fixed border-separate border-spacing-y-2">
                  <thead>
                    <tr>
                      <th></th>
                      <th v-for="choose in que.square.column" :key="choose.id" class="truncate text-base">{{ choose.text
                      }}</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr v-for="choose in que.square.row" :key="choose.id">
                      <th class="truncate text-base">{{ choose.text }}</th>
                      <td v-for="choosecol in que.square.column" :key="choosecol.id" class="text-center py-4">
                        <input type="radio" class="text-grey p-2" disabled>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
              <div v-if="que.type === 9">
                <table class="w-full table-fixed border-separate border-spacing-y-2">
                  <thead>
                    <tr>
                      <th></th>
                      <th v-for="choose in que.square.column" :key="choose.id" class="truncate text-base">{{ choose.text
                      }}</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr v-for="choose in que.square.row" :key="choose.id">
                      <th class="truncate text-base">{{ choose.text }}</th>
                      <td v-for="choosecol in que.square.column" :key="choosecol.id" class="text-center py-4">
                        <input type="checkbox" class="text-grey p-2" disabled>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
        <!-- {{ findAns }} -->
        <div v-for="item in findAns" :key="item.id">
          <FindAns :value="item" />
        </div>
      </div>
      <div v-else class="response-body">
        <div class="noreply">
          <span>待回應</span>
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
        @apply h-[150px] p-5 flex items-center;

        select {
          @apply rounded border-gray-200 w-[200px] h-[50px];
        }

        .select-btn {
          @apply w-[50px] h-[50px] p-3 hover:bg-grey-light rounded-[50%];
        }
      }

      #dot-box-switch {
        @apply hidden;
      }
    }

    .response-body {
      @apply flex flex-col mt-[15px];

      .noreply {
        @apply flex justify-center items-center text-[#686868] w-full min-h-[80px] border rounded-[10px] border-gray-200 mb-[15px] bg-white;
      }

      .responser {
        @apply w-full min-h-[80px] border rounded-[10px] border-gray-200 mb-[15px] px-5 py-2 bg-white text-[20px] flex items-start flex-col;
      }
    }
  }
}</style>


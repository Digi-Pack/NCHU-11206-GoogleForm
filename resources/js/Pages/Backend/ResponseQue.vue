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
      console.log(titles);
      return ansStringJson.map((item, index) => {
        return {
          id: index + 1,
          ans: item.find(ans => ans.id === titles),
          qus: formStringJson.find(qus => qus.id === titles),
        };
      });
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
          <h2 class="text-[28px] pb-10 font-bold">{{ response?.rt_data?.responseFormReply?.response_count ?? '' }}則回應</h2>
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
            <option v-for="item in response.rt_data.responseForm" :key="item.id" :value="item.id">
              {{ item.title }}
            </option>
          </select>
          <div class="flex ml-3">
            <button type="button" @click="minus()"><img :src="chevron_left" alt="" class="select-btn"></button>
            <div>
              <input type="number" :value="num"
                class="border-x-0 border-t-0 border-gray-200 border-[3px] w-[60px] focus:ring-0 focus:border-purple">項, 共
              4 項
            </div>
            <button type="button" @click="plus()"><img :src="chevron_right" alt="" class="select-btn"></button>
          </div>
        </div>
      </div>
      <div class="response-body">
        <div v-for="item in findAns" :key="item.id">
          <div v-for="item in response.rt_data.responseForm" :key="item.id">
            <div>
              <span v-if="item.id === titles">
                {{ item.title }}
              </span>
            </div>
          </div>
          <FindAns :value="item" />
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
        @apply flex justify-start items-center text-[#686868] w-full min-h-[80px] border rounded-[10px] border-gray-200 mb-[15px] bg-white;
      }

      .responser {
        @apply w-full min-h-[80px] border rounded-[10px] border-gray-200 mb-[15px] px-5 py-2 bg-white;

        .date {
          @apply text-grey flex flex-col gap-3 items-end;

          span {
            @apply text-black border-b;
          }
        }
      }
    }
  }
}
</style>


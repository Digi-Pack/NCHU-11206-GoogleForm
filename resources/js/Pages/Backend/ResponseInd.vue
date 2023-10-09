<script>
import excel from '/resources/images/excel.png';
import dot from '/resources/images/dot.png';
import download from '/resources/images/download.png';
import print from '/resources/images/print.png';
import del from '/resources/images/del.png';
import check from '/resources/images/check.png';
import linkoff from '/resources/images/link_off.png';
import chevron_left from '/resources/images/chevron_left.svg';
import chevron_right from '/resources/images/chevron_right.svg';

export default {
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
    };
  },
  methods: {
    currentUrl(urlName = '') {
      if (urlName === '') return;
      return route().current(urlName);
    },
    minus() {
      if (this.num === 1) return;
      this.num--;
    },
    plus() {
      this.num++;
    },
  },
};
</script>

<template>
  <section id="response" class="pt-[10px]">
    <div class="all">
      <div class="response-head bg-white">
        <div class="head-top">
          <h2 class="text-[28px] pb-10 font-bold">0 則回應</h2>
        </div>
        <div class="head-middle">
          <NavLink class="btn" :href="route('response.sum')" :active="currentUrl('response.sum')">
            摘要
          </NavLink>
          <NavLink class="btn" :href="route('response.que', { id: coFormId })" :active="currentUrl('response.que')">
            問題
          </NavLink>
          <NavLink class="btn" :href="route('response.ind')" :active="currentUrl('response.ind')">
            個別
          </NavLink>
        </div>
        <div class="head-fotter">
          <div class="flex ml-3">
            <button type="button" @click="minus()"><img :src="chevron_left" alt="" class="select-btn"></button>
            <div>第
              <input type="number" :value="num" class="border-x-0 border-t-0 border-gray-200 border-[3px] w-[60px] focus:ring-0 focus:border-purple">項, 共 4 項
            </div>
            <button type="button" @click="plus()"><img :src="chevron_right" alt="" class="select-btn"></button>
          </div>
          <button type="button">
            <label>
              <img :src="del" alt="" class="select-btn">
            </label>
          </button>
        </div>
      </div>
      <div class="response-body bg-white">
        <span>待回應</span>
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
        @apply flex min-h-[80px] justify-center items-center border rounded-[10px] border-gray-200;
            span {
                @apply text-[#686868];
            }
        }
                // @media (max-width:480px) {
                //     .to-excel {
                //         display: none;
            }
}

</style>


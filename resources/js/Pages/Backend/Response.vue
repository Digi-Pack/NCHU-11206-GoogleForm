<script>
import excel from '/resources/images/excel.png';
import dot from '/resources/images/dot.png';
import download from '/resources/images/download.png';
import print from '/resources/images/print.png';
import del from '/resources/images/del.png';
import check from '/resources/images/check.png';
import linkoff from '/resources/images/link_off.png';

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
      coFormId: route()?.params?.id ?? '0',
    };
  },
  methods: {
    currentUrl(urlName = '') {
      if (urlName === '') return;
      return route().current(urlName);
    },
  },
};
</script>

<template>
  <section id="response" class="pt-[10px]">
    <div class="all">
      <div class="response-head bg-white">
        <div class="head-top">
          <h2>0則回應</h2>
        </div>
        <div class="head-fotter">
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
      </div>
      <div class="response-body bg-white">
        <span>待回應</span>
      </div>
    </div>
  </section>
</template>

<style lang="scss" scoped>
#response {
    @apply h-screen mt-[20px] pb-[20px];
.all {
    @apply m-auto max-w-[770px] relative z-[2];
    .response-head {
        @apply my-[15px] rounded-[10px] border border-gray-200;

        .head-top {
            @apply pt-[16px] pr-[8px] ps-[24px] mb-10 flex justify-between items-center;
        }

        .head-fotter {
            @apply flex justify-around h-[40px];
            .btn {
              @apply p-[10px] text-[16px] rounded-none focus:bg-purple-light;
            }
        }
    }

    .response-body {
        @apply flex min-h-[80px] justify-center items-center border rounded-[10px] border-gray-200;
            span {
                @apply text-[#686868];
            }
        }
    }
}

</style>


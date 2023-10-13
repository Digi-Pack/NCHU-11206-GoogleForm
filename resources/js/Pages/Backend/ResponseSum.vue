<script>
import excel from '/resources/images/excel.png';
import dot from '/resources/images/dot.png';
import download from '/resources/images/download.png';
import print from '/resources/images/print.png';
import del from '/resources/images/del.png';
import check from '/resources/images/check.png';
import linkoff from '/resources/images/link_off.png';
import ResponseS from '@/Components/ResponseS.vue';

export default {
  components: {
    ResponseS,
  },
  props:
  {
    response: Object,
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
      data: this.response?.rt_data ?? '0',
      chartdata: this.response?.rt_data ?? '0',
      answer: this.response?.rt_data?.results ?? '0',
      whoAll: this.response?.rt_data?.whoAll ?? '0',
      noAnswer: false,
      coFormId: route()?.params?.id ?? '0',
      isActive: false,
    };
  },
  mounted() {
    this.noAnswer = JSON.stringify(this.answer) === JSON.stringify([]);
  },
  methods: {
    currentUrl(urlName = '') {
      if (urlName === '') return;
      return route().current(urlName);
    },
    accordion() {
      this.isActive = !this.isActive;
    },
  },
};
</script>

<template>

  <section id="response-sum" class="pt-[10px]">
    <div class="all">
      <div class="response-head bg-white">
        <div class="head-top">
          <h2 class="text-[28px] pb-10 font-bold">{{ response?.rt_data?.responseFormReply?.response_count ?? '' }} 則回應</h2>
        </div>
        <div class="head-fotter">
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
      </div>
      <div class="response-body">
        <div v-if="noAnswer === true" class="noreply">
          <span>待回應</span>
        </div>
        <div v-if="noAnswer === false" class="responser">
          <div class="title">哪些人已回應?</div>
          <div class="email">
            <button type="button" @click="accordion()" class="accordion" :class="{ 'active': isActive }">電子郵件</button>
            <div v-if="isActive" class="content">
              <div v-for="item in whoAll" :key="item.id">
                <div class="email-address"> {{ item }} </div>
              </div>
            </div>
          </div>
        </div>
        <div v-if="noAnswer === false">
          <ResponseS :chartdata="chartdata" />
        </div>
      </div>
    </div>
  </section>

</template>

<style lang="scss" scoped>
#response-sum {
    @apply min-h-[100vh] mt-[20px] pb-[20px];
.all {
    @apply m-auto max-w-[770px] relative z-[2];
    .response-head {
        @apply mt-[15px] rounded-[10px] border border-gray-200;

        .head-top {
            @apply pt-[16px] pr-[8px] ps-[24px] flex justify-between items-center;
        }
        .head-fotter {
            @apply flex justify-around h-[50px];
            .btn {
              @apply p-[10px] text-[16px] rounded-none focus:bg-purple-light;
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
                @apply flex flex-col justify-center items-start w-full min-h-[80px] border rounded-[10px] border-gray-200 mb-[15px] bg-white;
                .title {
                    @apply w-full text-[24px] font-semibold p-5 border-b;
                }
                .email {
                    @apply p-5 w-full;
                    .accordion {
                      @apply cursor-pointer bg-grey-middle p-[10px] rounded-t duration-300 rounded-b w-full;
                    }
                    .content {
                      @apply px-[10px] pt-[10px] w-full max-h-[300px] rounded-b bg-grey-light overflow-y-scroll;
                      &::-webkit-scrollbar{
                        @apply w-[1px];
                      }
                      &::-webkit-scrollbar-track {
                        @apply bg-grey-dark rounded-[10px];
                      }
                      &::-webkit-scrollbar-thumb{
                        @apply bg-grey rounded-[10px];
                      }
                    }
                    .active {
                      @apply bg-grey-dark rounded-none rounded-t text-gray-800;
                    }
                    span {
                        @apply text-lg font-semibold p-3;
                    }
                    .email-address {
                        @apply text-base mb-2 py-3 pl-3 bg-gray-50 rounded-md;
                    }
                }
            }
        }
    }
}

</style>


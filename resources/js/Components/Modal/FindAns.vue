<script>
import image from '/resources/images/image.png';

export default {
  props: {
    value: Object,
  },
  data() {
    return {
      image: image,
    };
  },
  methods: {
    arrayData(min, max) {
      let loopResult = [];
      for (let i = min; i <= max; i++) {
        loopResult.push(i);
      }
      return loopResult;
    },
  },
};
</script>

<template>
  <section id="findans">
    <!-- {{ value.qus.type }}
    {{ value.ans }} -->
    <!-- 簡答 -->
    <div v-if="value.qus.type === 1 && !value.ans" class="responser">
      <div class="text pt-5 ps-5">
        (使用者填寫表單時，未建立此問題)
      </div>
      <div class="reply"><a href="#">0 則回應</a></div>
    </div>
    <div v-if="value.qus.type === 1 && value.ans" class="responser">
      <div class="text">
        {{ value.ans.answer ?? '' }}
      </div>
      <div class="reply"><a href="#">1 則回應</a></div>
    </div>
    <!-- 詳答 -->
    <div v-if="value.qus.type === 2 && !value.ans" class="responser">
      <div class="text pt-5 ps-5">
        (使用者填寫表單時，未建立此問題)
      </div>
      <div class="reply"><a href="#">0 則回應</a></div>
    </div>
    <div v-if="value.qus.type === 2 && value.ans" class="responser">
      <div class="text">
        {{ value.ans.answer ?? '' }}
      </div>
      <div class="reply"><a href="#">1 則回應</a></div>
    </div>
    <!-- 選擇題 -->
    <div v-if="value.qus.type === 3 && !value.ans">
      <div class="responser pt-5 ps-5">
        (使用者填寫表單時，未建立此問題)
        <div class="reply"><a href="#">0 則回應</a></div>
      </div>
    </div>
    <div v-if="value.qus.type === 3 && value.ans">
      <div class="responser">
        <div v-for="(choose) in value.qus.options" :key="choose.id" class="option">
          <input type="radio" id="choice-1" class="ml-5 text-grey" disabled :checked="choose.id === parseInt(value.ans.answer)">
          <span class="text-[16px] px-5 text-grey">{{ choose.value }}</span>
        </div>

        <div class="reply"><a href="#">1 則回應</a></div>
      </div>
    </div>
    <!-- 核取方塊 -->
    <div v-if="value.qus.type === 4 && !value.ans">
      <div class="responser pt-5 ps-5">
        (使用者填寫表單時，未建立此問題)
        <div class="reply"><a href="#">0 則回應</a></div>
      </div>
    </div>
    <div v-if="value.qus.type === 4 && value.ans">
      <div class="responser">
        <div v-for="(choose) in value.qus.options" :key="choose.id" class="option">
          <!-- {{ value.ans.manyOptions.includes(String(choose.id)) }} -->
          <!-- {{ String(choose.id) }} -->
          <input type="checkbox" class="choice-2 ml-5 text-grey" disabled :checked="value.ans?.manyOptions?.includes(String(choose.id))">
          <span class="text-[16px] px-5 text-grey">{{ choose.value }}</span>
        </div>
        <div class="reply"><a href="#">1 則回應</a></div>
      </div>
    </div>
    <!-- 下拉式選單 -->
    <div v-if="value.qus.type === 5 && !value.ans">
      <div class="responser">
        <div class=" text-black text-[16px] px-5 py-2 my-3">
          (使用者填寫表單時，未建立此問題)
        </div>
        <div class="reply"><a href="#">0 則回應</a></div>
      </div>
    </div>
    <div v-if="value.qus.type === 5 && value.ans">
      <div class="responser">
        <div v-if="value.ans" class=" text-black text-[16px] px-5 py-2 my-3">
          {{ value.ans.answer ?? '' }}
        </div>
        <div class="reply"><a href="#">1 則回應</a></div>
      </div>
    </div>
    <!-- 檔案上傳 -->
    <div v-if="value.qus.type === 6 && !value.ans">
      <div class="responser flex flex-col justify-center pt-5 ps-5">
        (使用者填寫表單時，未建立此問題)
        <div class="reply"><a href="#">0 則回應</a></div>
      </div>
    </div>
    <div v-if="value.qus.type === 6 && value.ans">
      <div class="responser flex flex-col justify-center">
        <div class="p-3 m-3 border rounded-md w-[200px] truncate flex">
          <img :src="image" alt="" class="mr-2">
          <a :href="value.ans.file.path" :download="value.ans.file.name">{{ value.ans.file.name }}</a>
        </div>
        <div class="reply"><a href="#">1 則回應</a></div>
      </div>
    </div>
    <!-- 線性刻度 -->
    <div v-if="value.qus.type === 7 && !value.ans" class="!block responser pt-5 ps-5">
      (使用者填寫表單時，未建立此問題)
      <div class="reply"><a href="#">0 則回應</a></div>
    </div>
    <div v-if="value.qus.type === 7 && value.ans" class="!block responser">
      <div class="flex justify-center items-end">
        <div class="w-[80px] truncate text-black p-3 text-[18px]">{{ value.qus.linear.minText }}</div>
        <div v-for="(i, index) in arrayData(parseInt(value.qus.linear.min), parseInt(value.qus.linear.max))" :key=index>
          <div class="flex flex-col justify-center items-center py-4">
            <div class="p-5"> {{ i }}</div>
            <input type="radio" disabled v-if="index === parseInt(value.ans.manyOptions) - 1" class="p-3 text-grey" checked>
            <input type="radio" disabled v-else class="p-3">
          </div>
        </div>
        <div class="w-[80px] truncate text-black p-3 text-[18px]">{{ value.qus.linear.maxText }}</div>
      </div>
      <div class="reply"><a href="#">1 則回應</a></div>
    </div>
    <!-- 單選方格 -->
    <div v-if="value.qus.type === 8 && !value.ans">
      <div class="responser pt-5 ps-5">
        (使用者填寫表單時，未建立此問題)
        <div class="reply"><a href="#">0 則回應</a></div>
      </div>
    </div>
    <div v-if="value.qus.type === 8 && value.ans">
      <div class="responser px-5">
        <table class="w-full table-fixed border-separate border-spacing-y-2 pt-5">
          <thead>
            <tr>
              <th></th>
              <th v-for="choose in value.qus.square.column" :key="choose.id" class="truncate">{{ choose.text }}</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="choose in value.qus.square.row" :key="choose.id" class="bg-grey-light">
              <th class="truncate">{{ choose.text }}</th>
              <td v-for="choosecol in value.qus.square.column" :key="choosecol.id" class="text-center py-4">
                <input v-if="value.ans?.manyOptions?.includes(`row${choose.id}col${choosecol.id}`)" type="radio"
                  class="text-grey p-2" disabled checked>
                <input type="radio" class="text-grey p-2" disabled v-else>
              </td>
            </tr>
          </tbody>
        </table>
        <div class="reply"><a href="#">1 則回應</a></div>
      </div>
    </div>
    <!-- 核取方塊格 -->
    <div v-if="value.qus.type === 9 && !value.ans">
      <div class="responser pt-5 ps-5">
        (使用者填寫表單時，未建立此問題)
        <div class="reply"><a href="#">0 則回應</a></div>
      </div>
    </div>
    <div v-if="value.qus.type === 9 && value.ans">
      <div class="responser px-5">
        <table class="w-full table-fixed border-separate border-spacing-y-2 pt-5">
          <thead>
            <tr>
              <th></th>
              <th v-for="choose in value.qus.square.column" :key="choose.id" class="truncate">{{ choose.text }}</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="choose in value.qus.square.row" :key="choose.id" class="bg-grey-light">
              <th class="truncate">{{ choose.text }}</th>
              <td v-for="choosecol in value.qus.square.column" :key="choosecol.id" class="text-center py-4">
                <input v-if="value.ans?.manyOptions?.includes(`row${choose.id}col${choosecol.id}`)" type="checkbox"
                  class="text-grey p-2" disabled checked>
                <input type="checkbox" class="text-grey p-2" disabled v-else>
              </td>
            </tr>
          </tbody>
        </table>
        <div class="reply"><a href="#">1 則回應</a></div>
      </div>
    </div>
    <!-- 日期 -->
    <div v-if="value.qus.type === 10 && !value.ans">
      <div class="responser pt-5 ps-5">
        (使用者填寫表單時，未建立此問題)
        <div class="reply"><a href="#">0 則回應</a></div>
      </div>
    </div>
    <div v-if="value.qus.type === 10 && value.ans">
      <div class="responser">
        <div class="flex gap-1 px-3 pt-8 ml-3">
          <div class="date">MM</div>
          <div class="date">DD</div>
          <div class="date">YYYY</div>
        </div>
        <input type="date" disabled :value="value.ans.answer ?? ''" class="border-0 ml-4">
        <div class="reply"><a href="#">1 則回應</a></div>
      </div>
    </div>
    <!-- 時間 -->
    <div v-if="value.qus.type === 11 && !value.ans">
      <div class="responser pt-5 ps-5">
        (使用者填寫表單時，未建立此問題)
        <div class="reply"><a href="#">0 則回應</a></div>
      </div>
    </div>
    <div v-if="value.qus.type === 11 && value.ans">
      <div class="responser">
        <div class="flex flex-col gap-3 px-6 pt-8">
          <div class="text-grey">時間</div>
          <div class="flex w-[100px]">
            <div class="border-b w-[20px] ml-auto">{{ value.ans.time.hour }}</div> :
            <div class="border-b w-[20px] ml-auto">{{ value.ans.time.minute }}</div>
            <span v-if="value.ans.time.section === 'a.m.'" class="ml-3 text-grey font-bold">上午</span>
            <span v-if="value.ans.time.section === 'p.m.'" class="ml-3 text-grey font-bold">下午</span>
          </div>
        </div>
        <div class="reply"><a href="#">1 則回應</a></div>
      </div>
    </div>
  </section>
</template>

<style lang="scss" scoped>
#findans {
  .text {
    @apply text-black text-[22px] px-5 pt-5;
  }
  .reply {
    @apply px-3 py-2 my-3 ml-3 text-blue hover:bg-blue-light w-[90px];
  }

  .responser {
    @apply w-full min-h-[80px] border rounded-[10px] border-gray-200 mb-[15px] bg-white;
    .option {
      @apply px-3 py-2 my-3;
    }
    .date {
      @apply text-grey flex flex-col items-end;

      span {
        @apply text-black border-b;
      }
    }
  }
}
</style>

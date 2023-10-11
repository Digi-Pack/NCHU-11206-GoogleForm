<script>

export default {
  props: {
    value: Object,
  },
  data() {
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
    <!-- <div class="title">{{ value.ans.title }}</div> -->
    <!-- 簡答 -->
    <div v-if="value.qus.type === 1">
      <div class="text-black text-[22px] px-5">
        {{ value.ans.answer }}
      </div>
      <div class="px-3 py-2 my-3 ml-3 text-blue hover:bg-blue-light w-[85px]"><a href="#">1 則回應</a></div>
    </div>
    <!-- 詳答 -->
    <div v-if="value.qus.type === 2">
      <div class="text-black text-[22px] px-5">
        {{ value.ans.answer }}
      </div>
      <div class="px-3 py-2 my-3 ml-3 text-blue hover:bg-blue-light w-[85px]"><a href="#">1 則回應</a></div>
    </div>
    <!-- 選擇題 -->
    <div v-if="value.qus.type === 3">
      <div class="questype-3 responser bg-white border rounded-[10px] mb-[15px] border-gray-200">
        <div v-for="(choose) in value.qus.options" :key="choose.id" class="option px-3 py-2 my-3">
          <input type="radio" id="choice-1" class="ml-5 text-grey" disabled v-if="choose.id === value.ans.answer" checked>
          <input type="radio" id="choice-1" class="ml-5 text-grey" disabled v-else>
          <label for="choice-1" class="text-[16px] px-5">{{ choose.value }}</label>
        </div>
        <div class="px-3 py-2 my-3 ml-3 text-blue hover:bg-blue-light w-[85px]"><a href="#">1 則回應</a></div>
      </div>
    </div>
    <!-- 核取方塊 -->
    <div v-if="value.qus.type === 4">
      <div class="questype-4 responser  bg-white border rounded-[10px] mb-[15px] border-gray-200">
        <div v-for="(choose) in value.qus.options" :key="choose.id" class="option px-3 py-2 my-3">
          <input type="checkbox" class="choice-2 ml-5 text-grey p-2" disabled v-if="value.ans.manyOptions.includes(choose.id)" checked>
          <input type="checkbox" class="choice-2 ml-5 text-grey" disabled v-else>
          <label for="choice-2" class="text-[16px] px-5">{{ choose.value }}</label>
        </div>
        <div class="px-3 py-2 my-3 ml-3 text-blue hover:bg-blue-light w-[85px]"><a href="#">1 則回應</a></div>
      </div>
    </div>
    <!-- 下拉式選單 -->
    <div v-if="value.qus.type === 5">
      <div class=" bg-white border rounded-[10px] mb-[15px] border-gray-200">
        <div class="questype-5 responser text-black text-[16px] px-5 py-2 my-3">
          {{ value.ans.answer }}
        </div>
        <div class="px-3 py-2 my-3 ml-3 text-blue hover:bg-blue-light w-[85px]"><a href="#">1 則回應</a></div>
      </div></div>
    <!-- 檔案上傳 -->
    <div v-if="value.qus.type === 6" class="!block">
      <span class="text-[18px]">檔案上傳</span>
      <div class="questype-6 responser">
        <label for=""></label>
        <input type="file" name="" id="">
      </div>
      <div class="px-3 py-2 my-3 ml-3 text-blue hover:bg-blue-light w-[85px]"><a href="#">1 則回應</a></div>
    </div>
    <!-- 線性刻度 -->
    <div v-if="value.qus.type === 7" class="!block bg-white border rounded-[10px] mb-[15px] border-gray-200">
      <div class="questype-7 responser flex justify-center items-end">
        <div class="w-[80px] truncate text-black p-3 text-[18px]">{{ value.qus.linear.minText }}</div>
        <div v-for="(i, index) in arrayData(parseInt(value.qus.linear.min), parseInt(value.qus.linear.max))" :key=index>
          <div class="flex flex-col justify-center items-center py-4">
            <div class="p-5"> {{ i }}</div>
            <input type="radio" disabled v-if=" index === value.ans.manyOptions" class="p-3" checked>
            <input type="radio" disabled v-else class="p-3">
          </div>
        </div>
        <div class="w-[80px] truncate text-black p-3 text-[18px]">{{ value.qus.linear.maxText }}</div>
      </div>
      <div class="px-3 py-2 my-3 ml-3 text-blue hover:bg-blue-light w-[85px]"><a href="#">1 則回應</a></div>
    </div>
    <!-- 單選方格 -->
    <div v-if="value.qus.type === 8">
      <div class="questype-8 responser bg-white border rounded-[10px] mb-[15px] border-gray-200">
        <table>
          <thead>
            <tr>
              <th></th>
              <th v-for="choose in value.qus.square.column" :key="choose.id">{{ choose.text }}</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="choose in value.qus.square.row" :key="choose.id">
              <th>{{ choose.text }}</th>
              <td v-for="choosecol in value.qus.square.column" :key="choosecol.id">
                <th>{{ choosecol.text }}</th>
                <input v-if="value.ans.manyOptions.includes(`row${choose.id}col${choosecol.id}`)" type="radio" disabled checked>
                <input type="radio" disabled v-else>
              </td>
            </tr>
          </tbody>
        </table>
        <div class="px-3 py-2 my-3 ml-3 text-blue hover:bg-blue-light w-[85px]"><a href="#">1 則回應</a></div>
      </div>
    </div>
    <!-- 核取方塊格 -->
    <div v-if="value.qus.type === 9" class="!block">
      <div class="questype-9 responser bg-white border rounded-[10px] mb-[15px] border-gray-200">
        <table>
          <thead>
            <tr>
              <th></th>
              <th v-for="choose in value.qus.square.column" :key="choose.id">{{ choose.text }}</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="choose in value.qus.square.row" :key="choose.id">
              <th>{{ choose.text }}</th>
              <td v-for="choosecol in value.qus.square.column" :key="choosecol.id">
                <th>{{ choosecol.text }}</th>
                <input v-if="value.ans.manyOptions.includes(`row${choose.id}col${choosecol.id}`)" type="checkbox" disabled checked>
                <input type="checkbox" disabled v-else>
              </td>
            </tr>
          </tbody>
        </table>
        <div class="px-3 py-2 my-3 ml-3 text-blue hover:bg-blue-light w-[85px]"><a href="#">1 則回應</a></div>
      </div>
    </div>
    <!-- 日期 -->
    <div v-if="value.qus.type === 10" class="!block">
      <div class="questype-10 responser bg-white border rounded-[10px] mb-[15px] border-gray-200">
        <div class="flex justify-start gap-3 w-full px-3 pt-8">
          <div class="date">MM </div>
          <div class="date">DD </div>
          <div class="date">YYYY </div>
        </div>
        <input type="date" disabled :value="value.ans.answer" class="border-0">
        <div class="px-3 py-2 my-3 ml-3 text-blue hover:bg-blue-light w-[85px]"><a href="#">1 則回應</a></div>
      </div>
    </div>
    <!-- 時間 -->
    <div v-if="value.qus.type === 11" class="!block">
      <div class="questype-11 responser bg-white border rounded-[10px] mb-[15px] border-gray-200">
        <div class="flex flex-col items-start gap-3 w-full px-3 pt-8">
          <div class="date">時間</div>
          <div>
            <span class="border-b">{{ value.ans.time.hour }}</span> :
            <span class="border-b">{{ value.ans.time.minute }}</span>
            <span v-if="value.ans.time.section === 'a.m.'" class="ml-3 text-grey font-bold">上午</span>
            <span v-if="value.ans.time.section === 'p.m.'" class="ml-3 text-grey font-bold">下午</span>
          </div>
        </div>
        <div class="px-3 py-2 my-3 ml-3 text-blue hover:bg-blue-light w-[85px]"><a href="#">1 則回應</a></div>
      </div>
    </div>
    <!-- 影片 -->
    <div v-if="value.qus.type === 13" class="!block">
      <div class="p-5 flex justify-center">
        <iframe class="max-w-[600px] w-[90%] h-[400px]" :src="value.qus.video" title="YouTube video player" frameborder="0" allowfullscreen></iframe>
      </div>
    </div>

  </section>
</template>

<style lang="scss" scoped>
#findans {
    .title {
        @apply font-bold;
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
</style>

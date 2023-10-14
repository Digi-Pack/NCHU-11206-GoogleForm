<script>
import { router } from '@inertiajs/vue3';
import edit from '/resources/images/edit.svg';
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
      edit,
      title: 'Hello World !',
      formData: this.response,
      cantModify: this.response.rt_data.cantModify,
      formTitle: this.response.rt_data.formTitle,
      question_id: this.response.rt_data.question_id,
    };
  },
  methods: {
    submitData() {
      const { formData } = this;
      const getOldResponse = formData.rt_data;
      router.visit(route('reply.review'), {
        method: 'get', data: { getOldResponse }, preserveState: true,
      });
    },
  },
};
</script>

<template>
  <section id="frontend-index">
    <div class="content">
      <div class="w-full h-[15px] bg-purple rounded-t-lg"></div>
      <div class="px-7 pb-5">
        <div>
          <h1 class="title my-5">{{ formTitle }}</h1>
          <div class="flex flex-col gap-3">
            <p>我們已經收到您回覆的表單～</p>
            <p>這個平台上，除了問卷的主編輯者和共同編輯者之外，一般填寫者只能填寫一份問卷。</p>
            <p v-if="cantModify === false">如果您需要修改答案，可按下方「修改回覆內容」按鈕；</p>
            <p v-if="cantModify === false">或借由重新輸入一次問卷網址，您會被導向之前填寫過的該份問卷頁面，您同樣也可以在此修改回覆內容。</p>
          </div>
        </div>
        <div v-if="cantModify === false">
          <button type="button" class="btn-base mt-5" @click="submitData()">修改回覆內容</button>
        </div>
      </div>
    </div>
    <Link :href="route('edit.old', { id: question_id })">
      <button v-if="cantModify === true" type="button" class="btn"><img :src="edit" alt="">
        <span>編輯這個表單</span>
      </button>
    </Link>
  </section>
</template>

<style lang="scss" scoped>
#frontend-index {
  @apply w-full h-screen overflow-y-auto flex flex-col items-center bg-purple-light;
  .content {
  @apply w-[60%] max-w-2xl h-auto bg-white flex flex-col rounded-lg mt-[10px] border;
  .title {
    @apply text-[40px];
  }
  .btn-base {
    @apply p-1.5 border-2 rounded-md cursor-pointer text-sm shadow text-purple hover:bg-grey-light;
  }
  }
  .btn {
    @apply w-[52px] h-[52px] p-3 bg-white rounded-[50%] fixed right-[3.125rem] bottom-[3.125rem] shadow hover:bg-grey-light;
    &:hover {
      span {
        @apply block;
      }
    }
    span {
      @apply absolute w-[100px] -top-[30px] -left-[20px] bg-gray-500 text-white text-xs p-0.5 rounded hidden;
    }
  }
}
</style>

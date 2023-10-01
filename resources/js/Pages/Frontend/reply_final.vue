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
    };
  },
  methods: {
    submitData() {
      const { formData } = this;
      const getOldResponse = formData.rt_data;
      // if (this.imageSize > 3145728) return Swal.fire('圖片檔案過大');
      // 驗證
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
      <div class="px-7">
        <div>
          <h1 class="title my-5">未命名表單</h1>
          <div class="flex flex-col gap-3">
            <p>我們已經收到您回覆的表單～</p>
            <p>這份表單僅限填寫一次。</p>
            <p>如果你認為這項限制有誤，請與表單擁有者聯絡。</p>
          </div>
        </div>
        <div>
          <button type="button" class="btn-base mt-5" @click="submitData()">修改回覆內容</button>
        </div>
      </div>
    </div>
    <button type="button" class="btn"><img :src="edit" alt="">
      <span>編輯這個表單</span>
    </button>
  </section>
</template>

<style lang="scss" scoped>
#frontend-index {
    @apply w-full h-screen overflow-y-auto flex flex-col items-center bg-purple-light;
      .content {
        @apply w-[60%] max-w-2xl h-[300px] bg-white flex flex-col rounded-lg mt-[10px] border;
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

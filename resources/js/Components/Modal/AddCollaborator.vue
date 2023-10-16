<script>
import close from '/images/close.svg';
import link from '/images/link.svg';
import del from '/resources/images/del.png';
import { router } from '@inertiajs/vue3';
import Swal from 'sweetalert2';

export default {
  props: {
    coFormId: String,
  },
  emits: [
    'closeModel',
  ],
  data() {
    return {
      del: del,
      images: {
        close,
        link,
      },
      co_email: '',
      coformemail: [],
      formOwner: {},
    };
  },
  mounted() {
    this.getCoworker();
  },
  methods: {
    getCoworker() {
      const { coFormId } = this;
      router.visit(route('coformid.index'), {
        method: 'get', data: { coFormId }, preserveState: true,
        onSuccess: ({ props }) => {
          if (props.flash.message.rt_data.length === 1) {
            this.formOwner = props.flash.message.rt_data[0];
          } else {
            this.formOwner = props.flash.message.rt_data[1];
            this.coformemail = props.flash.message.rt_data[0];
          }
        },
      });
    },
    closing() {
      // this.show = false;
      this.$emit('closeModel');
    },
    submitDataId() {
      const { co_email } = this;
      const coFormIdNumber = parseInt(this.coFormId, 10);
      router.visit(route('coformid.store'), {
        method: 'post', data: { co_email, coFormIdNumber }, preserveState: true,
        onSuccess: ({ props }) => {
          if (props.flash.message.rt_code === 1) {
            Swal.fire({
              title: '新增成功',
              showDenyButton: true,
              confirmButtonText: '回列表',
              denyButtonText: '取消',
            }).then((result) => {
              if (result.isConfirmed) {
                router.get(route('guide.index'));
              }
            });
          } else {
            Swal.fire({
              title: '新增失败',
              text: props.flash.message.rt_message, // 这里使用消息的文本作为错误信息
              icon: 'error',
            });
          }
        },
      });
    },

    delQuestion(id) {
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
          router.visit(route('coformid.delete'), {
            method: 'delete', data: { id }, preserveState: true,
            onSuccess: ({ props }) => {
              if (props.flash.message.rt_code === 1) {
                Swal.fire(
                  '刪除成功',
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
  <section id="AddCollaborator">
    <div class="container">
      <form @submit.prevent="submitDataId()">
        <div class="content">
          <div class="flex justify-between items-center px-6">
            <h1 class="content-title text-[18px] text-black">將編輯者新增至表單</h1>
            <button type="button" class="text-[28px] font-bold text-black" @click="closing()">
              <img :src="images.close" alt="">
            </button>
          </div>
          <div class="pt-[15px]">
            <div class="flex flex-col gap-4">
              <div class="px-6 flex flex-col gap-4">
                <input v-model="co_email" type="email" class="w-full h-[45px] rounded-md text-[14px]"
                  placeholder="新增使用者">
                <p>具有存取權的使用者</p>
              </div>
              <div class="flex items-center gap-3 hover:bg-grey-light px-6 w-full">
                <div class="rounded-full bg-purple min-w-[22px] h-[22px]"></div>
                <div class="flex flex-col">
                  <span class="text-[12px]">{{ formOwner.name }}</span>
                  <span class="text-[12px] text-[#6e6e6e]">{{ formOwner.email }}</span>
                </div>
                <span class="w-[60%] text-[14px] text-grey flex justify-end">擁有者</span>
              </div>
              <div v-for="item in coformemail" :key="item.id"
                class="flex items-center gap-3 hover:bg-grey-light px-8 w-full">
                <div class="rounded-full bg-purple w-[22px] h-[22px]"></div>
                <div class="flex flex-col">
                  <span class="text-[12px]">{{ item.user.name }}</span>
                  <span class="text-[12px] text-[#6e6e6e]">{{ item.user.email }}</span>
                </div>
                <span class="w-[60%] text-[14px] text-grey flex justify-end">編輯者</span>
                <button type="button" @click="delQuestion(item.id)">
                  <label>
                    <img :src="del" alt="">
                  </label>
                </button>
              </div>
            </div>
            <div class="flex justify-end mt-7 px-8">
              <button type="submit"
                class="btn px-5 py-2 rounded-[45px] bg-blue text-white hover:shadow hover:shadow-gray-400">完成</button>
            </div>
          </div>
        </div>
      </form>
    </div>
  </section>
</template>

<style lang="scss" scoped>
#AddCollaborator {
  .container {
    @apply w-full h-screen fixed top-0 left-0 bg-[#e6e6e65a] z-20;
    .content {
      @apply w-[500px] bg-white rounded-xl border shadow-lg absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 py-8;
      @media (max-width: 550px) {
        @apply w-[90%];
      }
    }
  }
}
</style>

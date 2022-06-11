<template>
    <div class="flex items-end justify-between mt-5 px-3 py-3 bg-gray-100">
        <input type="text" class="flex-grow m-2 py-2 px-4 mr-1 rounded-full border border-gray-300 resize-none" placeholder="Escribe algo..." v-model="form.content" @keyup.enter="method">
        <button class="rounded-full transition duration-150 ease-in-out bg-orange-400 m-2 mb-2 hover:bg-orange-300 focus:outline-none" :class="{ 'opacity-25' : form.processing}" :disabled="form.processing" @click="method">
        
        <svg
          class="svg-inline--fa text-orange-400 fa-paper-plane fa-w-16 w-10 h-10 py-2 mr-2"
          aria-hidden="true"
          focusable="false"
          data-prefix="fas"
          data-icon="paper-plane"
          role="img"
          xmlns="http://www.w3.org/2000/svg"
          viewBox="0 0 512 512"
        >
          <path
            fill="white"
            d="M476 3.2L12.5 270.6c-18.1 10.4-15.8 35.6 2.2 43.2L121 358.4l287.3-253.2c5.5-4.9 13.3 2.6 8.6 8.3L176 407v80.5c0 23.6 28.5 32.9 42.5 15.8L282 426l124.6 52.2c14.2 6 30.4-2.9 33-18.2l72-432C515 7.8 493.3-6.8 476 3.2z"
          />
        </svg>
      </button>
    </div>
</template>

<script>
    export default {
        props: ['form', 'item', 'method']
    }
</script>
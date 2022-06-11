<template>
  <div>
    <Head title="Iniciar sesión" />
    <div class="bubbles">
      <div class="bubble"></div>
      <div class="bubble"></div>
      <div class="bubble"></div>
      <div class="bubble"></div>
      <div class="bubble"></div>
      <div class="bubble"></div>
      <div class="bubble"></div>
      <div class="bubble"></div>
      <div class="bubble"></div>
      <div class="bubble"></div>
      <div class="bubble"></div>
      <div class="bubble"></div>
      <div class="bubble"></div>
      <div class="bubble"></div>
      <div class="bubble"></div>
      <div class="bubble"></div>
      <div class="bubble"></div>
      <div class="bubble"></div>
      <div class="bubble"></div>
      <div class="bubble"></div>
      <div class="bubble"></div>
      <div class="bubble"></div>
      <div class="bubble"></div>
      <div class="bubble"></div>
      <div class="bubble"></div>
      <div class="bubble"></div>
      <div class="bubble"></div>
      <div class="bubble"></div>
      <div class="bubble"></div>
      <div class="bubble"></div>
      <div class="bubble"></div>
      <div class="bubble"></div>
      <div class="bubble"></div>
      <div class="bubble"></div>
      <div class="bubble"></div>
      <div class="bubble"></div>
      <div class="bubble"></div>
      <div class="bubble"></div>
      <div class="bubble"></div>
      <div class="bubble"></div>
      <div class="bubble"></div>
      <div class="bubble"></div>
      <div class="bubble"></div>
      <div class="bubble"></div>
      <div class="bubble"></div>
      <div class="bubble"></div>
      <div class="bubble"></div>
      <div class="bubble"></div>
      <div class="bubble"></div>
      <div class="bubble"></div>
   
    <jet-authentication-card>
      <template #logo>
        <Link :href="route('welcome')">
          <img :src="'storage/images/logo.png'" alt="Logo" width="90" class="border rounded-full border-white" />
        </Link>
      </template>

      <jet-validation-errors class="mb-4" />

      <div v-if="status" class="mb-4 font-medium text-sm text-green-600">
        {{ status }}
      </div>

      <form @submit.prevent="submit">
        <div>
          <jet-label for="email" value="Email" class="text-lg font-inter text-midnight-green text-bold" />
          <jet-input
            id="email"
            type="email"
            class="mt-1 block w-full"
            v-model="form.email"
            required
            autofocus
          />
        </div>

        <div class="mt-4">
          <jet-label for="password" value="Contraseña" class="text-lg font-inter text-midnight-green text-bold"/>
          <jet-input
            id="password"
            type="password"
            class="mt-1 block w-full"
            v-model="form.password"
            required
            autocomplete="current-password"
          />
        </div>

        <div class="block mt-4">
          <label class="flex items-center">
            <jet-checkbox name="remember" :checked="form.remember" />
            <span class="ml-2 text-sm text-gray-600">Recordarme</span>
          </label>
        </div>

        <div class="flex items-center justify-end mt-4">
          <Link
            v-if="canResetPassword"
            :href="route('password.request')"
            class="underline text-sm text-gray-600 hover:text-gray-900"
          >
           ¿Has olvidado tu contraseña?
          </Link>

          <jet-button
            class="ml-4"
            :class="{ 'opacity-25': form.processing }"
            :disabled="form.processing"
          >
            Entrar
          </jet-button>
        </div>
      </form>
    </jet-authentication-card>
     </div>
  </div>
</template>

<script>
import { defineComponent } from "vue";
import JetAuthenticationCard from "@/Jetstream/AuthenticationCard.vue";
import JetButton from "@/Jetstream/Button.vue";
import JetInput from "@/Jetstream/Input.vue";
import JetCheckbox from "@/Jetstream/Checkbox.vue";
import JetLabel from "@/Jetstream/Label.vue";
import JetValidationErrors from "@/Jetstream/ValidationErrors.vue";
import { Head, Link } from "@inertiajs/inertia-vue3";

export default defineComponent({
  components: {
    Head,
    JetAuthenticationCard,
    JetButton,
    JetInput,
    JetCheckbox,
    JetLabel,
    JetValidationErrors,
    Link,
  },

  props: {
    canResetPassword: Boolean,
    status: String,
  },

  data() {
    return {
      form: this.$inertia.form({
        email: "",
        password: "",
        remember: false,
      }),
    };
  },

  methods: {
    submit() {
      this.form
        .transform((data) => ({
          ...data,
          remember: this.form.remember ? "on" : "",
        }))
        .post(this.route("login"), {
          onFinish: () => this.form.reset("password"),
        });
    },
  },
});
</script>

<style lang="scss" scoped>
body {
  background: #1a1e23;
  margin: 0;
}

$bubble-count: 50;
$sway-type: "sway-left-to-right", "sway-right-to-left";

@function random_range($min, $max) {
  $rand: random();
  $random_range: $min + floor($rand * (($max - $min) + 1));
  @return $random_range;
}

@function sample($list) {
  @return nth($list, random(length($list)));
}

.bubbles {
  position: relative;
  width: 100%;
  height: 100vh;
  overflow: hidden;
}

.bubble {
  position: absolute;
  left: var(--bubble-left-offset);
  bottom: -75%;
  display: block;
  width: var(--bubble-radius);
  height: var(--bubble-radius);
  border-radius: 50%;
  animation: float-up var(--bubble-float-duration) var(--bubble-float-delay) ease-in infinite;

  &::before {
    position: absolute;
    content: '';
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: hsla(183, 94%, 76%, 0.3);
    border-radius: inherit;
    animation: var(--bubble-sway-type) var(--bubble-sway-duration) var(--bubble-sway-delay) ease-in-out alternate infinite;
  }

  @for $i from 0 through $bubble-count {
    &:nth-child(#{$i}) {
      --bubble-left-offset: #{random_range(0vw, 100vw)};
      --bubble-radius: #{random_range(1vw, 10vw)};
      --bubble-float-duration: #{random_range(6s, 12s)};
      --bubble-sway-duration: #{random_range(4s, 6s)};
      --bubble-float-delay: #{random_range(0s, 4s)};
      --bubble-sway-delay: #{random_range(0s, 4s)};
      --bubble-sway-type: #{sample($sway-type)};
    }
  }
}

@keyframes float-up {
  to {
    transform: translateY(-175vh);
  }
}

@keyframes sway-left-to-right {
  from {
    transform: translateX(-100%);
  }

  to {
    transform: translateX(100%);
  }
}

@keyframes sway-right-to-left {
  from {
    transform: translateX(100%);
  }

  to {
    transform: translateX(-100%);
  }
}
</style>

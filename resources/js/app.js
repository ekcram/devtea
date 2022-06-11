require('./bootstrap');

import { createApp, h } from 'vue';
import { createInertiaApp, Head, Link } from '@inertiajs/inertia-vue3';
import { InertiaProgress } from '@inertiajs/progress';
import Icon from './Components/Icon.vue'
import DotLoader from 'vue-spinner/src/DotLoader.vue'
import { quillEditor, Quill } from 'vue3-quill'
import ImageResize from 'quill-image-resize'
Quill.register('modules/imageResize', ImageResize);

import moment from 'moment';
import 'moment/locale/es';

window.Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    iconColor: 'white',
    customClass: {
      popup: 'colored-toast'
    },
    showConfirmButton: false,
    timer: 3000,
    didOpen: (toast) => {
      toast.addEventListener('mouseenter', Swal.stopTimer)
      toast.addEventListener('mouseleave', Swal.resumeTimer)
    }
})

// const appName = window.document.getElementsByTagName('title')[0]?.innerText || 'Laravel';

createInertiaApp({
    // title: (title) => `${title} - ${appName}`,
    resolve: (name) => require(`./Pages/${name}.vue`),
    setup({ el, App, props, plugin }) {  
      const app = createApp({render: () => h(App, props, plugin)})
            .use(plugin)
            .use(quillEditor)
            .component('InertiaHead', Head)
            .component('InertiaLink', Link)
            .component('Icon', Icon)
            .component('DotLoader',DotLoader)
            .mixin({ methods: { route } })
            app.config.globalProperties.$filters = {
              timeAgo(created) {
                moment.locale('es')
                return moment(created).fromNow()
              },
              // El resto de filters van aquí
          }
          app.mount(el);  
    },
    
});

InertiaProgress.init({ color: '#4B5563' });

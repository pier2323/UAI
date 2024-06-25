import './bootstrap';


import intlTelInput from 'intl-tel-input';
import Swal from 'sweetalert2';

window.addEventListener('swal', function(event) {
    Swal.fire(event.detail);
});
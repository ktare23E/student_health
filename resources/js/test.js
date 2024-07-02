console.log('bag o ni sya');



document.querySelectorAll('.open-modal').forEach(button => {
    button.addEventListener('click', () => {
        const modalId = button.getAttribute('data-modal');
        const modal = document.getElementById(modalId);
        modal.classList.remove('hidden');
        setTimeout(() => {
            modal.classList.add('modal-enter-active');
            modal.classList.remove('modal-enter');
        }, 10);
    });
});

document.querySelectorAll('.close').forEach(button => {
    button.addEventListener('click', () => {
        const modal = button.closest('.fixed');
        modal.classList.add('modal-leave-active');
        modal.classList.remove('modal-enter-active');
        modal.addEventListener('transitionend', () => {
            modal.classList.add('hidden');
            modal.classList.remove('modal-leave-active');
            modal.classList.add('modal-enter');
        }, { once: true });
    });
});

window.addEventListener('click', (event) => {
    document.querySelectorAll('.fixed').forEach(modal => {
        if (event.target === modal) {
            modal.classList.add('modal-leave-active');
            modal.classList.remove('modal-enter-active');
            modal.addEventListener('transitionend', () => {
                modal.classList.add('hidden');
                modal.classList.remove('modal-leave-active');
                modal.classList.add('modal-enter');
            }, { once: true });
        }
    });
});
// document.addEventListener('DOMContentLoaded', function() {
//     // Listen for click events on elements with the data-modal-toggle attribute
//     document.querySelectorAll('[data-modal-toggle]').forEach(function(toggleBtn) {
//         toggleBtn.addEventListener('click', function() {
//             // Get the target modal ID from the data-modal-toggle attribute
//             var target = toggleBtn.getAttribute('data-modal-toggle');
//             var modal = document.getElementById(target);

//             if (modal) {
//                 // Toggle the "hidden" class on the modal
//                 modal.classList.toggle('hidden');
//             }
//         });
//     });
// });

// function closeModal(modalId) {
//     document.addEventListener("DOMContentLoaded", function() {
//         const modal = document.getElementById(`${modalId}`);
//         modal.addEventListener('click', function(event) {
//             const modalContent = modal.querySelector('.relative');
//             if (!modalContent.contains(event.target)) {
//                 modal.classList.add('hidden');
//             }
//         });
//     });
// }

// closeModal('edit_business');

class Notification {
    success() {
        new Noty({
            type: 'success',
            layout: 'topRight',
            text: 'Successfully Done',
            timeout: 1000,

        }).show();
    }


    cart_success() {
        new Noty({
            type: 'success',
            layout: 'topRight',
            text: 'Added To Cart Successfully',
            timeout: 1000,

        }).show();
    }

    cart_delete() {
        new Noty({
            type: 'success',
            layout: 'topRight',
            text: 'Removed From Cart Successfully',
            timeout: 1000,

        }).show();

    }


    alert() {
        new Noty({
            type: 'alert',
            layout: 'topRight',
            text: 'Are You Sure?',
            timeout: 1000,

        }).show();
    }

    error() {
        new Noty({
            type: 'alert',
            layout: 'topRight',
            text: 'Some thing went wrong!',
            timeout: 1000,

        }).show();
    }

    warning() {
        new Noty({
            type: 'warning',
            layout: 'topRight',
            text: 'Oops went wrong!!!',
            timeout: 1000,

        }).show();
    }


    image_validation() {
        new Noty({
            type: 'error',
            layout: 'topRight',
            text: 'Upload Image Less Than 1 MB',
            timeout: 1000,

        }).show();
    }


}

export default Notification = new Notification();

class Notification {

	success(){
		new Noty({
		    type: 'success',
		    layout: 'topRight',
		    text: 'Successfully Done !',
		    timeout: 1000,
		}).show();
	}

	cart_success(){
		new Noty({
		    type: 'success',
		    layout: 'topRight',
		    text: 'Successfully Added To The Cart!',
		    timeout: 1000,
		}).show();
	}

	cart_delete(){
		new Noty({
		    type: 'warning',
		    layout: 'topRight',
		    text: 'Successfully Deleted From The  Cart!',
		    timeout: 1000,
		}).show();
	}

	cart_increment(){
		new Noty({
		    type: 'info',
		    layout: 'topRight',
		    text: 'Item Incremented Successfully!',
		    timeout: 1000,
		}).show();
	}

	cart_decrement(){
		new Noty({
		    type: 'warning',
		    layout: 'topRight',
		    text: 'Item Decremented Successfully!',
		    timeout: 1000,
		}).show();
	}

	alert(){
		new Noty({
		    type: 'alert',
		    layout: 'topRight',
		    text: 'are you sure ?',
		    timeout: 1000,
		}).show();
	}

	error(){
		new Noty({
		    type: 'error',
		    layout: 'topRight',
		    text: 'Something went wrong !',
		    timeout: 1000,
		}).show();
	}

	warning(){
		new Noty({
		    type: 'warning',
		    layout: 'topRight',
		    text: 'Oops ! wrong',
		    timeout: 1000,
		}).show();
	}

	image_validation(){
		new Noty({
		    type: 'error',
		    layout: 'topRight',
		    text: 'Upload Image Less Than 1mb',
		    timeout: 1000,
		}).show();
	}

} 

export default Notification = new Notification()
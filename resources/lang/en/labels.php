<?php

return [
  'navigation' => [
      'home' => 'Home',
      'shop' => 'Shop',
      'about' => 'About',
      'contact' => 'Contact',
      'dashboard' => 'Dashboard',
      'orders' => 'Orders',
      'wishlist' => 'Wishlist',
  ],
    'fields' => [
        'product' => 'Product',
        'name' => 'Name',
        'description' => 'Description',
        'price' => 'Price',
        'image' => 'Image',
        'email' => 'Email',
        'phone' => 'Phone',
        'address' => 'Address',
        'optional' => 'Optional',
        'filter' => 'Filter',
        'category' => 'Category',
        'categories' => 'Categories',
        'products' => 'Products',
        'our_shop' => 'Our Shop',
        'quantity' => 'Quantity',
        'subtotal' => 'Subtotal',
        'shipping' => 'Shipping',
        'total' => 'Total',
        'select' => 'Select',
        'featured' => 'Featured',
        'discount' => 'Discount',
        'limited' => 'Limited',
        'shopping_cart' => 'Shopping Cart',
        'checkout' => 'Checkout',
        'cities' => 'Cities',
        'communes' => 'Communes',
        'details' => 'Details',
        'desk' => 'Desk',
        'home' => 'Home',
        'password' => 'Password',
        'register' => 'Register',
        'gender' => 'Gender',
        'male' => 'Male',
        'female' => 'Female',
        'confirm_password' => 'Confirm Password',
        'change_password' => 'Change Password',
        'current_password' => 'Current Password',
        'new_password' => 'New Password',
        'save_changes' => 'New Password',
        'my_account' => 'My Account',
        'account' => 'Account',
        'my_orders' => 'My Orders',
        'state' => 'State',
        'date' => 'Date',
        'actions' => 'Actions',
        'order'=> 'Order',
        'wishlist'=> 'Wishlist',
        'orders'=> 'Orders',
        'my_wishlist'=> 'My Wishlist',
        'logout' => 'Logout',
        'profile' => 'Profile',
        'login' => 'Login',
        'remove' => 'Remove',
    ],

    'text'=>[
        'see_our_shop' => 'Browse through our shop for the latest fashion',
        'add_to_cart' => 'Add to Cart',
        'add_to_wishlist' => 'Add to Wishlist',
        'remove_from_wishlist' => 'Remove From Wishlist',
        'remove_from_cart' => 'Remove From Cart',
        'recently_viewed' => 'Recently Viewed',
        'your_cart_is_empty' => 'Your cart is empty',
        'go_shopping' => 'Go shopping',
        'calc_at_checkout' => 'Calculated at checkout',
        'view_cart' => 'View Cart',
        'continue_shopping' => 'Continue Shopping and enjoy our offers',
        'you_want_gift_wrap' => 'You want to gift wrap',
        'your_order' => 'Your order',
        'login_with_google' => 'Login with Google',
        'register_with_google' => 'Register with Google',
        'forgot_password' => 'Forgot Password',
        'dont_have_account' => 'Don\'t have an account? Register here',
        'already_have_account' => 'Already have an account? Login here',
        'sign_up_here'  => 'Sign up here for early access to our new arrivals and offers',
        'your_wishlist_is_empty' => 'Your wishlist is empty',
    ],
    'sort' => [
        'price_asc' => 'Price from low to high',
        'price_desc' => 'Price from high to low',
        'name_asc' => 'Name A to Z',
        'name_desc' => 'Name Z to A',
        'created_at_asc' => 'Newest first',
        'created_at_desc' => 'Oldest first',
        'featured' => 'Featured first',
        'discount' => 'Best discount first',
        'default' => 'Default',
    ],
    'errors' => [
        'name_required' => 'The name field is required.',
        'name_string' => 'The name must be a valid string.',
        'name_max' => 'The name must not exceed 100 characters.',

        'email_invalid' => 'Please enter a valid email address.',

        'phone_required' => 'The phone number is required.',
        'phone_string' => 'The phone number must be a valid string.',
        'phone_max' => 'The phone number must not exceed 50 characters.',

        'wilayat_required' => 'Please select a city.',
        'wilayat_integer' => 'Invalid city selection.',
        'wilayat_exists' => 'The selected city is invalid.',

        'shipping_required' => 'Please choose a shipping method.',
        'shipping_integer' => 'Invalid shipping selection.',
        'shipping_in' => 'The selected shipping method is invalid.',

        'address_required_if' => 'The address is required when choosing home delivery.',
        'address_string' => 'The address must be a valid string.',
        'address_max' => 'The address must not exceed 200 characters.',

        'commune_integer' => 'Invalid commune selection.',
        'commune_required' => 'Commune selection is required.',
    ],

    'singles'=>[
        'only' => 'Only'
    ]
];

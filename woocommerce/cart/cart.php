<?php
/**
 * Cart Page
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/cart/cart.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 3.1.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
?>
<div class="cart-main-area area-padding">
    <div class="container">
      
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12">
<?php
wc_print_notices();

do_action( 'woocommerce_before_cart' ); ?>

<form action="<?php echo esc_url( wc_get_cart_url() ); ?>" method="post">

<?php do_action( 'woocommerce_before_cart_table' ); ?>
  <div class="cart-table table-responsive">
<table class="cart-table table-responsive" cellspacing="0">
	<thead>
		<tr>
			<th class="p-times">&nbsp;</th>
			<th class="p-image"><?php _e( 'Product Image', 'hamzahshop' ); ?></th>
			<th class="p-name"><?php _e( 'Product', 'woocommerce' ); ?></th>
			<th class="p-amount"><?php _e( 'Price', 'woocommerce' ); ?></th>
			<th class="p-quantity"><?php _e( 'Quantity', 'woocommerce' ); ?></th>
			<th class="p-total"><?php _e( 'Total', 'woocommerce' ); ?></th>
		</tr>
	</thead>
	<tbody>
		<?php do_action( 'woocommerce_before_cart_contents' ); ?>

		<?php
		foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
			$_product   = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
			$product_id = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );

			if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_cart_item_visible', true, $cart_item, $cart_item_key ) ) {
				$product_permalink = apply_filters( 'woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink( $cart_item ) : '', $cart_item, $cart_item_key );
				?>
				<tr class="<?php echo esc_attr( apply_filters( 'woocommerce_cart_item_class', 'cart_item', $cart_item, $cart_item_key ) ); ?>">

					<td class="p-action">
						<?php
							echo apply_filters( 'woocommerce_cart_item_remove_link', sprintf(
								'<a href="%s" title="%s" data-product_id="%s" data-product_sku="%s"><i class="fa fa-times"></i></a>',
								esc_url( WC()->cart->get_remove_url( $cart_item_key ) ),
								__( 'Remove this item', 'woocommerce' ),
								esc_attr( $product_id ),
								esc_attr( $_product->get_sku() )
							), $cart_item_key );
						?>
					</td>

					<td class="p-image">
						<?php
							$thumbnail = apply_filters( 'woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key );

							if ( ! $product_permalink ) {
								echo $thumbnail;
							} else {
								printf( '<a href="%s">%s</a>', esc_url( $product_permalink ), $thumbnail );
							}
						?>
					</td>

					<td class="p-name" data-title="<?php _e( 'Product', 'woocommerce' ); ?>">
						<?php
							if ( ! $product_permalink ) {
								echo apply_filters( 'woocommerce_cart_item_name', $_product->get_title(), $cart_item, $cart_item_key ) . '&nbsp;';
							} else {
								echo apply_filters( 'woocommerce_cart_item_name', sprintf( '<a href="%s">%s</a>', esc_url( $product_permalink ), $_product->get_title() ), $cart_item, $cart_item_key );
							}

							// Meta data
							echo WC()->cart->get_item_data( $cart_item );

							// Backorder notification
							if ( $_product->backorders_require_notification() && $_product->is_on_backorder( $cart_item['quantity'] ) ) {
								echo '<p class="backorder_notification">' . esc_html__( 'Available on backorder', 'woocommerce' ) . '</p>';
							}
						?>
					</td>

					<td class="p-amount" data-title="<?php _e( 'Price', 'woocommerce' ); ?>">
						<?php
							echo apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price( $_product ), $cart_item, $cart_item_key );
						?>
					</td>

					<td class="p-quantity" data-title="<?php _e( 'Quantity', 'woocommerce' ); ?>">
						<?php
							if ( $_product->is_sold_individually() ) {
								$product_quantity = sprintf( '1 <input type="hidden" name="cart[%s][qty]" value="1" />', $cart_item_key );
							} else {
								$product_quantity = woocommerce_quantity_input( array(
									'input_name'  => "cart[{$cart_item_key}][qty]",
									'input_value' => $cart_item['quantity'],
									'max_value'   => $_product->backorders_allowed() ? '' : $_product->get_stock_quantity(),
									'min_value'   => '0'
								), $_product, false );
							}

							echo apply_filters( 'woocommerce_cart_item_quantity', $product_quantity, $cart_item_key, $cart_item );
						?>
					</td>

					<td class="p-total" data-title="<?php _e( 'Total', 'woocommerce' ); ?>">
						<?php
							echo apply_filters( 'woocommerce_cart_item_subtotal', WC()->cart->get_product_subtotal( $_product, $cart_item['quantity'] ), $cart_item, $cart_item_key );
						?>
					</td>
				</tr>
				<?php
			}
		}

		do_action( 'woocommerce_cart_contents' );
		?>
		<?php do_action( 'woocommerce_after_cart_contents' ); ?>
	</tbody>
</table>
	<div class="all-cart-buttons">
	

		<div class="floatright">
		<input type="submit" class="cart_button" name="update_cart" value="<?php esc_attr_e( 'Update Cart', 'hamzahshop' ); ?>" />

					<?php do_action( 'woocommerce_cart_actions' ); ?>

					<?php wp_nonce_field( 'woocommerce-cart' ); ?>
		
		</div>
		<div class="clearfix"></div>
	</div>
</div>
<?php do_action( 'woocommerce_after_cart_table' ); ?>


<div class="row all-cart-button">
    <div class="col-md-4">
    
    </div>

    <?php if ( wc_coupons_enabled() ) { ?>

    <div class="col-md-4">
        <div class="shipping-discount">
            <div class="shipping-title">
                <h3><?php esc_attr_e( 'Discount Code', 'hamzahshop' ); ?></h3>
            </div>
            <p><?php esc_attr_e( 'Enter your coupon code if you have one', 'hamzahshop' ); ?></p>
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="postal-code">
                       <input type="text" name="coupon_code" class="input-text" id="coupon_code" value="" placeholder="<?php esc_attr_e( 'Coupon code', 'woocommerce' ); ?>" />
                    </div>
                    <div class="buttons-set">
                     
                         <input type="submit" class="cart_button pull-left" name="apply_coupon" value="<?php esc_attr_e( 'Apply Coupon', 'hamzahshop' ); ?>" />

				<?php do_action( 'woocommerce_cart_coupon' ); ?>
                    </div>
                </div>
            </div>    
        </div>
    </div>

<?php } ?>

    <div class="col-md-4">
        <div class="amount-totals">
        	<?php do_action( 'woocommerce_cart_collaterals' ); ?>
            
            <div class="clearfix"></div>
           
        </div>
    </div>
</div>


</form>



<?php do_action( 'woocommerce_after_cart' ); ?>
		</div>
	</div>
</div>
</div>		
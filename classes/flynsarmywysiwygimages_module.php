<?

	class FlynsarmyWYSIWYGImages_Module extends Core_ModuleBase {
		protected function createModuleInfo() {
			return new Core_ModuleInfo(
				"WYSIWYG Images",
				"Adds improved image editing functionality to WYSIWYG fields.",
				"Flynsarmy"
			);
		}

		public function subscribeEvents() {
			Backend::$events->addEvent('blog:onExtendPostForm', $this, 'extend_blog_post_form');
			Backend::$events->addEvent('shop:onExtendProductForm', $this, 'extend_shop_product_form');
			Backend::$events->addEvent('cms:onExtendPageForm', $this, 'extend_cms_page_form');
			Backend::$events->addEvent('shop:onExtendCategoryForm', $this, 'extend_shop_category_form');
			Backend::$events->addEvent('flynsarmyprodfields:afterFieldAdded', $this, 'extend_custom_prod_field');
			Backend::$events->addEvent('flynsarmyslideshow:onExtendSlideForm', $this, 'extend_slideshow_slide_form');
		}

		/**
		 * Blog post extensions
		 */

		public function extend_blog_post_form($post, $context) {
			if ( $context != 'preview' )
			{
				$field = $post->find_form_field('content');
				$field->htmlPlugins .= ',advimage';
				$field->htmlButtons1 .= ',advimage';
			}
		}

		/**
		 * Shop product extensions
		 */

		public function extend_shop_product_form($product, $context) {
			if ( !in_array($context, array('preview', 'option-matrix')) )
			{
				$field = $product->find_form_field('description');
				$field->htmlPlugins .= ',advimage';
				$field->htmlButtons1 .= ',advimage';
			}
		}

		public function extend_custom_prod_field($field_details, $field)
		{
			if ( $field_details->type == FlynsarmyProdFields_Field::FIELD_WYSIWYG )
			{
				$field->htmlPlugins .= ',advimage';
				$field->htmlButtons1 .= ',advimage';
			}
		}

		/**
		 * Shop category extensions
		 */

		public function extend_shop_category_form($category) {
			$field = $category->find_form_field('description');
			$field->htmlPlugins .= ',advimage';
			$field->htmlButtons1 .= ',advimage';
		}

		/**
		 * CMS page extensions
		 */

		public function extend_cms_page_form($page) {
			$blocks = $page->list_content_blocks();

			foreach($blocks as $block) {
				$column_name = 'content_block_' . $block->code;

				$field = $page->find_form_field($column_name);
				if ( $field )
				{
					$field->htmlPlugins .= ',advimage';
					$field->htmlButtons1 .= ',advimage';
				}
			}
		}

		/**
		 * Slideshow slide extensions
		 */
		public function extend_slideshow_slide_form($slide, $context) {
			$field = $slide->find_form_field('description');
			$field->htmlPlugins .= ',advimage';
			$field->htmlButtons1 .= ',advimage';
		}
	}

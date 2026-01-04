<?php
/**
 * Title: Contact form
 * Slug: personal-website/contact-form
 * Keywords: contact
 * Categories: contact
 * Description: Contact section with message.
 */
?>

<!-- wp:paragraph {"style":{"typography":{"lineHeight":"1.5"}}} -->
<p style="line-height:1.5"><?php echo esc_html__( 'Drop me a message below and I’ll reach out soon.', 'personal-website' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:jetpack/contact-form {"confirmationType":"text","jetpackCRM":false,"salesforceData":{"organizationId":"","sendToSalesforce":false},"mailpoet":{"listId":null,"listName":null,"enabledForForm":false},"metadata":{"categories":["forms"],"patternName":"contact-form","name":"Contact Form"}} -->
<div class="wp-block-jetpack-contact-form"><!-- wp:jetpack/field-name {"id":"","required":true} -->
<div><!-- wp:jetpack/label {"label":"Name"} /-->

<!-- wp:jetpack/input {"style":{"border":{"style":"solid"}}} /--></div>
<!-- /wp:jetpack/field-name -->

<!-- wp:jetpack/field-email {"id":"","required":true} -->
<div><!-- wp:jetpack/label {"label":"Email"} /-->

<!-- wp:jetpack/input {"style":{"border":{"style":"solid"}}} /--></div>
<!-- /wp:jetpack/field-email -->

<!-- wp:jetpack/field-textarea {"id":""} -->
<div><!-- wp:jetpack/label {"label":"Message"} /-->

<!-- wp:jetpack/input {"type":"textarea","style":{"border":{"style":"solid"}}} /--></div>
<!-- /wp:jetpack/field-textarea -->

<!-- wp:jetpack/button {"element":"button","text":"Contact Me","lock":{"remove":true}} /--></div>
<!-- /wp:jetpack/contact-form -->

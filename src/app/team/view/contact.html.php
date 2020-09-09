<?php 
	use n2n\impl\web\ui\view\html\HtmlView;
	use page\ui\PageHtmlBuilder;
	use team\bo\TeamMember;
	use rocket\impl\ei\component\prop\string\cke\ui\CkeHtmlBuilder;
	use n2n\impl\web\ui\view\html\img\Mimg;

	$view = HtmlView::view($this);
	$html = HtmlView::html($this);
	
	$member = $view->getParam('teamMember');
	$view->assert($member instanceof TeamMember);
	
	$pageHtml = new PageHtmlBuilder($view);
	$ckeHtml = new CkeHtmlBuilder($view);

	$titlePrefix = '';
	
	$html->meta()->setTitle($member->getFullName() . $titlePrefix, true);
	$html->meta()->addMeta(['name' => 'description', 'content' => $member->t()->getFunction() . ' bei Hofmänner New Media'], 'name');
	$html->meta()->addMeta(['name' => 'robots', 'content' => 'noindex, nofollow'], 'name');
	
	$view->useTemplate('\bstmpl\view\bsTemplate.html', ['title' => $member->getFullName()]);
?>

	<?php $html->image($member->getFileImage(), Mimg::crop(300, 400), array('class' => 'img-fluid')) ?>
	
	<p class="lead"><?php $html->out($member->t()->getFunction()) ?></p>
	
	<?php if (null !== $description = $member->t()->getDescriptionHtml()): ?>
		<?php $ckeHtml->out($description) ?>
	<?php endif ?>
	
	<dl class="row">
		<?php if (null !== $phone = $member->getPhoneOfMemberOrLocation()): ?>
			<dt class="col-sm-3 col-lg-2"><?php $html->text('member_phone') ?>:</dt>
			<dd class="col-sm-9 col-lg-10"><?php $html->link('tel:' . TeamMember::formatPhoneLink($phone), $phone)?></dd>
		<?php endif ?>
		<?php if (null !== $mobile = $member->getMobile()): ?>
			<dt class="col-sm-3 col-lg-2"><?php $html->text('member_mobile') ?>:</dt>
			<dd class="col-sm-9 col-lg-10"><?php $html->out($mobile)?></dd>
		<?php endif ?>
		<?php if (null !== $email = $member->getEmailOfMemberOrLocation()): ?>
			<dt class="col-sm-3 col-lg-2">E-Mail:</dt>
			<dd class="col-sm-9 col-lg-10"><?php $html->linkEmail($email)?></dd>
		<?php endif ?>
		<?php if (null != $location = $member->getLocation()): ?>
		<dt class="col-sm-3 col-lg-2"><?php $html->text('member_address')?></dt>
		<dd class="col-sm-9 col-lg-10"><?php $html->escBr($location->getAddressStr()) ?></dd>
		<?php endif ?>
	</dl>
	
	<?php $html->linkToController(['vcard', $member->getPathPart(), $member->getCode()], 'Karte herunterladen', ['class' => 'btn btn-primary'])?>

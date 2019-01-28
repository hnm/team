<?php 
	use n2n\impl\web\ui\view\html\HtmlView;
	use n2n\impl\web\ui\view\html\img\Mimg;
use team\bo\TeamMember;
use n2n\web\http\nav\Murl;
use bstmpl\ui\TemplateHtmlBuilder;
	
	$view = HtmlView::view($view);
	$html = HtmlView::html($view);
	
	$detailLinkAvailable = $view->getParam('detailLinkAvailable', false, false);
	$teamMembers = $view->getParam('teamMembers');
	
	$tmplHtml = new TemplateHtmlBuilder($view);
?>
<div class="row">
	<?php foreach ($teamMembers as $teamMember): $view->assert($teamMember instanceof TeamMember) ?>
		<article class="team-member-entry col-md-4">
			<?php if (null !== $image = $teamMember->getFileImage()): ?>
					<?php $html->image($image, Mimg::crop(400, 400), array('class' => 'img-fluid rounded-circle')) ?>
			<?php endif ?>
			
			<h3>
				<?php $html->out($teamMember->getFullName()) ?>
				<?php if (null !== ($function = $teamMember->t($view->getN2nLocale())->getFunction())): ?>
					<small><?php $html->out($function) ?></small>
				<?php endif ?>
			</h3>
			
			
			<?php if (null !== $phone = $teamMember->getPhone()): ?>
				<dl>
					<dt><?php $html->text('member_phone') ?></dt>
					<dd><?php $html->link($tmplHtml->getPhoneUrl($phone), $phone) ?></dd>
				</dl>
			<?php endif ?>
			
			<?php if (null !== $email = $teamMember->getEmail()): ?>
				<dl>
					<dt><?php $html->text('member_email') ?></dt>
					<dd><?php $html->linkEmail($email) ?></dd>
				</dl>
			<?php endif ?>
			
			<?php if ($detailLinkAvailable): ?>
				<?php $html->link(Murl::controller()->pathExt([$teamMember->getId()])) ?>
			<?php endif ?>
		</article>
	<?php endforeach ?>
</div>
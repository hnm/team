<?php
	use n2n\impl\web\ui\view\html\HtmlView;
	use team\bo\TeamMember;
use bstmpl\ui\TemplateHtmlBuilder;
use bootstrap\img\MimgBs;
use n2n\impl\web\ui\view\html\img\Mimg;
	
	$view = HtmlView::view($view);
	$html = HtmlView::html($view);
	
	$teamMember = $view->getParam('teamMember');
	$view->assert($teamMember instanceof TeamMember);
	
	$phone = $teamMember->getPhone();
	$email = $teamMember->getEmail();
	$fileImage = $teamMember->getFileImage();
	
	$tmplHtml = new TemplateHtmlBuilder($view);
?>
<article class="team-member<?php $html->out(null !== $fileImage ? ' row' : null) ?>">
	<?php if (null !== $fileImage): ?>
		<div class="col-md-4">
			<?php $html->image($teamMember->getFileImage(), MimgBs::xs(Mimg::crop(400, 400)), array('class' => 'img-fluid rounded-circle'))?>
		</div>
		<div class="col-md-8">
	<?php endif ?>
	<h2>
		<?php $html->out($teamMember->getFullName()) ?>
		<?php if (null !== ($function = $teamMember->t($view->getN2nLocale())->getFunction())): ?>
			<small><?php $html->out($function) ?></small>
		<?php endif ?>
	</h2>
	<?php if (null !== $phone || null !== $email): ?>
		<div class="team-member-contact-data">
			<?php if (null !== $phone): ?>
				<dl>
					<dt><?php $html->text('member_phone') ?></dt>
					<dd>
						<?php $html->link(TeamMember::formatPhoneLink($phone), $phone) ?>
					</dd>
				</dl>
			<?php endif ?>
			<?php if (null !== $email): ?>
				<dl>
					<dt><?php $html->text('member_email') ?></dt>
					<dd>
						<?php $html->linkEmail($email) ?> 
					</dd>
				</dl>
			<?php endif ?>
		</div>
	<?php endif ?>
	<?php if (null !== $fileImage): ?>
		</div>
	<?php endif ?>
</article>

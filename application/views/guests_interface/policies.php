<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
<head>
	<?php $this->load->view('guests_interface/includes/head');?>
</head>
<body>
	<div class="wrapper">
		<?php $this->load->view('guests_interface/includes/ie7');?>
		<?php $this->load->view('guests_interface/includes/header');?>
		<div class="dark-screen"></div>
		<div class="window-donation">
			<?php $this->load->view('guests_interface/forms/donation');?>
		</div>
		<?php $this->load->view('guests_interface/includes/recall-div');?>
		<?php $this->load->view('guests_interface/includes/sn-tooltips');?>
		<?php $this->load->view('guests_interface/includes/main-menu');?>
		<?php $this->load->view('guests_interface/includes/auth');?>
		<div class="clear"></div>
		<div class="container_5">
			<div class="grid_1 left-boxes shop">
				<?php $this->load->view('guests_interface/includes/left-nav');?>
				<div style="position: relative;">
					<div class="gift-pad"<?=(isset($style))?$style:'';?> style="position: absolute !important;">
						<img src="<?=baseURL('img/book.png');?>">
						<div>
							<h2><span><?=lang('gift_pad_h2')?></span></h2>
							<p><?=lang('gift_pad_text')?></p>
							<a href="<?=site_url('catalog');?>" class="button red"><?=lang('gift_pad_button')?></a>
						</div>
					</div>
				</div>
			</div>
				<p class="about-title title-1"</p>
				<p class="about-text typo-normal-text">
					
				</p>
			<div class="grid_4 news-one" style="margin-top: 0;">
                <p style="text-align: center;">ПОЛЬЗОВАТЕЛЬСКОЕ СОГЛАШЕНИЕ</p><br>

1.	Термины и определения
<br>1.1.	Пользователь – дееспособное физическое лицо, зарегистрировавшееся на Сайте.
<br>1.2.	Сайт – сайт под доменным именем distribbooks.com и/или distribbooks.ru. 
<br>1.3.	Продавец – Индивидуальный предприниматель Сидельников Роман Леонидович:
<br>Почтовый и юридический адрес: Россия, 344029, Ростов-на-Дону, ул. Металлургическая, дом №111, квартира №19.
<br>Тел. +7 916 608-65-54
<br>ИНН 616112581558
<br>Генеральный директор: Сидельников Роман Леонидович
<br>Сайт осуществляет свою работу ежедневно 24 в сутки, за исключением времени, необходимого для поддержания и обновления сайта (технические работы) и возможных сбоев на сервере.
<br>Заказ Товаров Пользователи могут осуществить ежедневно, круглосуточно, посредством использования Сайта.
<br>1.4.	Товар – электронная ссылка на право единоразового скачивания с Сайта Продавца приобретаемой Пользователем электронной книги, предназначенной исключительно для личного, индивидуального потребления Пользователем (без права ее копирования, перепродажи и использования в интересах третьих лиц) и предлагаемые Продавцом посредством Сайта.
<br>1.5.	Персональный раздел Сайта – раздел Сайта (совокупность страниц Сайта), содержащий информацию, касающуюся заказов Пользователя.
<br>2.	Регистрация на Сайте
<br>2.1.	Пользовательское соглашение считается заключенным с момента подтверждения Пользователем регистрации на Сайте и подтверждении принятия условий Пользовательского соглашения. С текстом Пользовательского соглашения Пользователь может ознакомиться на Сайте.
<br>2.2.	Регистрация на Сайте может быть осуществлена Пользователем до стадии оформления заказа. В случае если Пользователь не был зарегистрирован на Сайте до стадии оформления заказа, регистрация Пользователя на Сайте осуществляется на стадии оформления заказа.
<br>2.3.	Регистрация Пользователя на Сайте осуществляется посредством заполнения им полей анкеты на странице регистрации и выполнения иных действий, там указанных, включая выражение согласия с Пользовательским соглашением.
<br>2.4.	При регистрации на Сайте Пользователь указывает в соответствующих полях анкеты страницы регистрации свои имя и адрес электронной почты.
<br>2.5.	По желанию Пользователя им могут быть предоставлены дополнительные сведения, указываемые в соответствующих полях анкеты страницы регистрации.
<br>2.6.	Продавец ведет базу данных зарегистрированных Пользователей. При этом Пользователь соглашается с тем, что Продавец при выявлении опасности действий Пользователя для функционирования Сайта вправе удалить информацию о Пользователе из базы данных зарегистрированных Пользователей (в том числе информацию о произведенных Пользователем действиях на Сайте).
<br>3.	Порядок осуществления покупок с использованием Сайта
<br>3.1.	Пользователь посредством Сайта самостоятельно знакомиться с информацией о Товарах и добавляет в "Корзину" товары, которые желает приобрести. Пользователю также, как правило, предоставляется возможность выбора из предложенных Продавцом способов оплаты и форматов скачиваемого Товара.
<br>3.2.	Договор купли-продажи Товара между Продавцом и Пользователем считается заключенным, а обязательства Продавца по передаче Товара и иные обязательства, связанные с передачей Товара, возникшими - с момента завершения Пользователем процедуры оформления и оплаты заказа, как это предусмотрено Пользовательским соглашением и на Сайте (подтверждение заказа в соответствии с порядком, предусмотренным функционалом Сайта).
<br>Текст Пользовательского соглашения и условия договора купли-продажи (с перечнем приобретаемого Товар, ценой и др.данными) – может направляться Пользователю по электронной почте.
<br>3.3.	Заказать Товар по телефону Пользователь не может.
<br>3.4.	В целях получения оплаты от Пользователя Продавец вправе привлекать третьих лиц (платежных агентов и агрегаторов). В таком случае Пользователь обязуется соблюдать правила и порядок оплаты, предусмотренный такими третьими лицами.
<br>3.5.	На Сайте указаны приблизительные сроки доставки. Продавец не отвечает за увеличение сроков доставки, вызванных возможными сбоями в работе серверов и технических служб поддержки работоспособности Сайта, не являющихся подразделениями Продавца.
<br>4.	Персональные данные
<br>4.1.	Пользователь понимает, что Продавец обрабатывает персональные данные Пользователя только с целью надлежащего исполнения Пользовательского соглашения. Тем не менее, Пользователь дополнительный раз подтверждает свое согласие на обработку его персональных данных, в т.ч. на сбор (включая получение информации от самого Пользователя и от третьих лиц), запись, систематизацию, накопление, хранение, уточнение (обновление, изменение), извлечение, использование, передачу (распространение, предоставление, доступ), обезличивание, блокирование, уничтожение персональных данных. 
<br>4.2.	Способы обработки персональных данных, как правило, включают в себя сбор персональных данных посредством заполнения Пользователем форм на Сайте, направления информации по электронной почте. Продавец также может собирать данные Пользователя из общедоступных источников и/или путем получения их от третьих лиц в целях проверки предоставленных Пользователем данных на достоверность.
<br>4.3.	Пользователь дает свое согласие на обработку Продавцом технической информации об ЭВМ, с которых Заказчик осуществляет доступ к Сайту и направляет электронные письма, в том числе, помимо прочего: IP-адрес, MAC-адрес, место нахождения ЭВМ, информацию об операционной системе, Интернет-браузере, разрешении экрана. Данная информация обрабатывается Продавцом  для идентификации Пользователя при исполнении Договора, а также в целях развития Сайта и оптимизации Сайта и Персонального раздела Сайта под Пользователя.
<br>4.4.	Продавец вправе обрабатывать данные Пользователя в статистических целях, однако в этом случае данные обезличиваются. Пользователь понимает и соглашается, что Продавец может делать общедоступными его данные, при условии их обезличивания (в статистических целях), а именно: без привязки фамилии, имени и отчества к остальным данным Пользователя.
<br>4.5.	Продавец обрабатывает персональные данные Пользователя в течение всего срока действия Договора, а обезличенные данные и после его окончания.
<br>4.6.	Пользователь дает свое согласие на обработку Продавцом его персональных данных в целях оповещения Пользователя о новинках и новостях Сайта, рекламных акциях, специальных предложения, иной информации, связанной с деятельностью Продавца.
<br>4.7.	Продавец вправе на основании автоматизированной обработки данных Пользователя принимать решения, порождающие юридические последствия в отношении Пользователя или иным образом затрагивающие его права и/или законные интересы, в том числе вправе производить розыгрыши, акции и т.п. (предоставлять скидки, бонусы, дополнительные услуги на безвозмездной и возмезной основе и т.д.).
<br>4.8.	Пользователь несет ответственность за достоверность предоставленных им персональных данных, за их изменение или удаление, совершенные под логином и паролем Пользователя. Пользователь компенсирует Продавцу убытки, понесенные вторым в связи с предоставлением Пользователем недостоверных персональных данных.
<br>5.	Прочие условия
<br>5.1.	Пользовательское соглашение может изменяться Продавцом в одностороннем порядке без специального уведомления Пользователей. Новая редакция Пользовательского соглашения вступает в силу, а прежняя его редакция утрачивает юридическую силу с момента размещения на Сайте новой редакции Пользовательского соглашения.
<br>5.2.	Адрес постоянного размещения актуальной редакции Пользовательского соглашения: _______________________.
<br>5.3.	Продавец предоставляет гарантию на Товар – 14 (четырнадцать) календарных дней с момента приобретения Пользователем Товара, при правильном соблюдении Пользователем технических требований к скачиванию и использованию Товара.
<br>5.4.	Пользователь вправе отказаться от Товара в любое время до момента его передачи Продавцом, по указанному Пользователем адресу электронной почты.
<br>5.5.	Возврат Товара надлежащего качества Продавцу – не возможен.
<br>5.6.	Возврат денежных средств, уплаченных Пользователем за Товар, осуществляется Продавцом не позднее 10 (десяти) банковских дней с даты принятия Продавцом предъявленного Пользователем соответствующего требования, одним из следующих способов, согласованных Сторонами:
<br>А) Почтовым переводом;
<br>В) Путем перечисления соответствующей суммы на банковский или иной счет Пользователя, указанный им в своем требовании.
<br>5.7.	В случае возврата денежных средств Пользователю, он компенсирует Продавцу расходы связанные с подготовкой и обработкой заказа оформленного Пользователем на оплаченный Товар.
<br>5.8.	Все действия, совершенные Пользователем с использованием логина и пароля, указанными Пользователем при регистрации на Сайте, являются действиями Пользователя, совершенными или санкционированными Пользователем, поскольку только Пользователь имеет сведения о сочетании логина и пароля (простая электронная подпись). Пользователь обязуется сохранять их конфиденциальность.
<br>5.9.	Пользователь и Продавец соглашаются с тем, что сообщения, направленные Пользователем Продавцу с адреса электронной почты, указанного Пользователем при регистрации на Сайте, и Продавцом Пользователю с адресов электронной почты, указанных на Сайте, имеют юридическую силу и признаются Пользователем и Продавцом равнозначными документам на бумажных носителях, подписанным собственноручной подписью, поскольку только Пользователь и Продавец (а также уполномоченные ими лица) имеют доступ к соответствующим адресам электронной почты, являющимся электронной подписью соответственно Пользователя или Продавца. Доступ к электронной почте Пользователь и Продавец осуществляют по паролю и обязуются сохранять его конфиденциальность.
<br>5.10.	Принимая условия настоящего соглашения, Пользователь подтверждает свою осведомленность на право использования Товара исключительно в личных целях, без права копирования, перепродажи, использования в интересах третьих лиц и не санкционированного Продавцом цитирования содержимого Товара, без письменного согласия Продавца.
<br>
<br>Форма настоящего Пользовательского соглашения, являющегося публичной офертой ИП Сидельников Роман Леонидович утверждена. Если Вы не согласны с каким-либо условием или оно Вам непонятно, просьба не выполнять указанных в Пользовательском соглашении действий (регистрацию), а прежде связаться с нами для получения разъяснений.
<br>
<br>

             </div>
        </div>
		<div class="clear"></div>
		<div class="container_5">
			<div class="min-nav pos3">
				<?php $this->load->view('guests_interface/includes/small-nav');?>
			</div>
		</div>
		<div class="clearfix"></div>
		<div class="yellow">
			<div class="container_5">
				<div style="position: relative;"><img src="<?=baseURL('img/shadow-y.png');?>" class="shadow-top"></div>
				<div class="grid_1">&nbsp;</div>
				<div class="grid_4">
					<h2><span class="sale-title">Акция:</span></h2>
					<img src="<?=baseURL('img/sale.png')?>" class="sale">
					<div class="position: relative;"><a href="#" class="button red sale">Выбрать книги</a></div>
				</div>
			</div>
		</div>
		<?php $this->load->view('guests_interface/includes/footer');?>
	</div>
	<?php $this->load->view('guests_interface/includes/scripts');?>
</body>
</html>
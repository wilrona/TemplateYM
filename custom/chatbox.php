<?php
/**
 * Created by IntelliJ IDEA.
 * User: online2
 * Date: 19/10/2017
 * Time: 15:26
 */

?>


<div id="wp-live-chat" style="margin-bottom: 0px; right: 20px; bottom: 0px; display: block;" class="modern  wplc_close">
	<div class="wp-live-chat-wraper">

		<div class="chatbox chatbox--tray chatbox--closed chatbox--empty">
			<div class="chatbox__title">
				<h5><span>Service Client</span></h5>
				<!-- <button class="chatbox__title__tray">
					<span></span>
				</button> -->
				<button class="chatbox__title__close">
                        <span>
                            <svg viewBox="0 0 12 12" width="12px" height="12px">
                                <line stroke="#FFFFFF" x1="11.75" y1="0.25" x2="0.25" y2="11.75"></line>
                                <line stroke="#FFFFFF" x1="11.75" y1="11.75" x2="0.25" y2="0.25"></line>
                            </svg>
                        </span>
				</button>
			</div>
			<div class="chatbox__body" style="display: none">

			</div>
			<form class="chatbox__credentials uk-form-stacked">
				<div class="uk-margin">
                    <label for="" class="uk-form-label">Nom:</label>
                    <input type="text" class="uk-input uk-border-rounded" id="inputName" required>
				</div>
				<div class="uk-margin">
                    <label for="" class="uk-form-label">Adresse Email: </label>
					<input type="email" class="uk-input uk-border-rounded" id="inputEmail" required>
				</div>
				<button type="submit" class="uk-button uk-button-small uk-button-secondary uk-width-1-1 uk-submit-conversation">Lancez la conversation</button>
			</form>
			<textarea class="chatbox__message" placeholder="Votre message"></textarea>
		</div>

		<div id="wp-live-chat-header" class="wplc-color-bg-1 wplc-color-2"> </div>
		<div id="wp-live-chat-text" class=""> Je suis en ligne</div>
		<div id="wplc-chat-alert" class="wplc-chat-alert wplc-chat-alert--theme-6"></div>
	</div>
</div>
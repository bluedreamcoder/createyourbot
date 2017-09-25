<?php

namespace Create;


class CreateWS {
	/**
	 * @var array
	 */
	private $apiData;
	/**
	 * @var array
	 */
	private $answer;

	private $answerFields;

	/**
	 * CreateWS constructor.
	 *
	 */
	public function __construct(  ) {

		$this->apiData = [
			'content' => [],
			'keyboard' => [],
			'return_user_answer' => false,
			'state' => 0,
			'session' => null
		];

		$this->answerFields = [
			'from_id', 'from_firstname',  'from_lastname', 'from_username',
			'date', 'message_id', 'chat_id', 'private', 'button_id',
			'bot_username', 'type', 'content', 'text', 'session', 'state'
		];

		$this->setAnswer();

	}

	/**
	 * @param string $text
	 * @param null|string $mediaUrl
	 * @param string $type
	 * @param null|array $inlineKeyboard
	 *
	 * @return array
	 */
	public function addNewContent( $text, $mediaUrl = null, $type = 'text', $inlineKeyboard = null ) {
		$newContent = [
			'text' => $text,
			'data' => $mediaUrl,
			'type' => $type,
			'inline_keyboard' => $inlineKeyboard
		];

		return $this->apiData['content'][] = $newContent;;
	}

	/**
	 * @param array $keyboard
	 *
	 * @return array
	 */
	public function setKeyboard( $keyboard ) {
		return $this->apiData['keyboard'] = $keyboard;
	}


	/**
	 * @param bool|string $url
	 *
	 * @return bool|string
	 */
	public function setReturnUrl( $url ) {
		return $this->apiData['return_user_answer'] = $url;
	}

	/**
	 * @param int $state
	 *
	 * @return int
	 */
	public function setState( $state ) {
		return $this->apiData['state'] = $state;
	}

	/**
	 * @param $session
	 *
	 * @return mixed
	 */
	public function setSession( $session ) {
		return $this->apiData['session'] = $session;
	}


	/**
	 * @return string
	 */
	public function getApiData() {
		return json_encode( $this->apiData );
	}


	private function setAnswer( ) {
		global $_POST, $_FILES;
		foreach ($this->answerFields as $field)
			if ( isset($_POST[$field]) ) $this->answer[$field] = $_POST[$field];
			else if ( isset($_FILES[$field]) ) $this->answer[$field] = $_FILES[$field];
	}

	/**
	 * @param string $filed
	 *
	 * @return mixed|null
	 */
	public function getAnswerField( $filed ) {
		if ( isset( $this->answer[$filed]) ) return $this->answer[$filed];
		else return null;
	}

	/**
	 * @return array
	 */
	public function getAllAnswerFields() {
		return $this->answer;
	}

	public function outputJson() {
		header('Content-type: application/json');
		echo $this->getApiData();
	}
}
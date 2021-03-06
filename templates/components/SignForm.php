<?php
class SignForm {
    protected ?string $action = null;
    protected ?string $submit = null;
    protected ?bool $pwdConfirm = null;

    function __construct(?string $action, ?string $submit, ?bool $pwdConfirm) {
        $this->action = $action;
        $this->submit = $submit;
        $this->pwdConfirm = $pwdConfirm;
    }

    private function get_confirm_input() {
        if (!$this->pwdConfirm) {
            return "";
        }
        return '
            <input type="password" class="input" placeholder="Confirm your password" id="password-confirm" name="password-confirm">
        ';
    }
    
    public function render() {
        echo sprintf('
        <div class="sign-card">
            <form method="POST" action="%s">
                <input type="email" class="input" placeholder="your_email@mail.com" id="email" name="email" />
                <input type="password" class="input" placeholder="Enter your password" id="password"
                    name="password">
                %s
                <button type="submit" class="btn secondary">
                    %s
                </button>
                <p class="sign-error">Error message</p>
            </form>
        </div>
        ', $this->action, $this->get_confirm_input(), $this->submit);
    }
}
?>
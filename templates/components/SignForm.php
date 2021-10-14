<?php
class SignForm {
    protected ?string $action = null;
    protected ?string $submit = null;

    function __construct(?string $action, ?string $submit) {
        $this->action = $action;
        $this->submit = $submit;
    }
    
    public function render() {
        echo sprintf('
        <div class="sign-card">
            <form method="POST" action="%s">
                <input type="email" class="input" placeholder="your_email@mail.com" id="email" name="email" />
                <input type="password" class="input" placeholder="Enter your password here" id="password"
                    name="password">
                <button type="submit" class="btn secondary">
                    %s
                </button>
            </form>
        </div>
        ', $this->action, $this->submit);
    }
}
?>
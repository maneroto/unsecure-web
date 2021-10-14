<?php

class TaskItem {
    protected ?string $title = null;
    protected ?string $urgency = null;
    protected ?string $description = null;
    protected ?string $dueDate = null;

    function __construct(?string $title, ?string $urgency, ?string $description, ?string $dueDate) {
        $this->title = $title;
        $this->urgency = $urgency;
        $this->description = $description;
        $this->dueDate = $dueDate;
    }

    private function get_badge() {
        $word = null;
        $color = null;
        switch ($this->urgency) {
            case 2: $word = "Mid"; $color = "secondary"; break;
            case 3: $word = "High"; $color = "warning"; break;
            case 1: default: $word = "Low"; $color = "accent"; break; 
        }
        return sprintf('
        <p class="badge %s">
            %s
        </p>
        ', $color, $word);
    }
    
    public function render() {
        echo sprintf('
        <div class="task-item">
            <div class="task-item-header">
                <h3>
                    %s
                </h3>
                %s
            </div>
            <div class="task-item-body">
                <p>
                    %s
                </p>
            </div>
            <div class="task-item-footer">
                <button class="btn warning">
                    Done
                </button>
                <p class="task-item-date">
                    Due: %s
                </p>
            </div>
        </div>
        ', $this->title, $this->get_badge(), $this->description, $this->dueDate);
    }
}

?>
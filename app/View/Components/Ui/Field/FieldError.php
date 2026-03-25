<?php

namespace App\View\Components\Ui\Field;

use App\View\Components\BaseUiComponent;

class FieldError extends BaseUiComponent
{
    private const BASE_CLASSES = 'text-destructive text-sm font-normal';

    /**
     * @param  array<int, mixed>  $messages
     */
    public function __construct(
        protected array $messages = [],
        protected string $class = ''
    ) {
        parent::__construct(
            viewPath: 'components.ui.field.field-error',
            baseClasses: self::BASE_CLASSES,
            class: $class
        );
    }

    /**
     * @return array<string, mixed>
     */
    protected function exposeToView(): array
    {
        return [
            'messages' => $this->uniqueMessages(),
        ];
    }

    /**
     * @return array<int, string>
     */
    private function uniqueMessages(): array
    {
        $result = [];

        foreach ($this->messages as $error) {
            $message = $this->extractMessage($error);

            if ($message !== null && $message !== '') {
                $result[] = $message;
            }
        }

        return array_values(array_unique($result));
    }

    private function extractMessage(mixed $error): ?string
    {
        if (is_string($error)) {
            return $error;
        }

        if (is_array($error)) {
            $message = $error['message'] ?? null;

            return is_string($message) ? $message : null;
        }

        if (is_object($error) && isset($error->message) && is_string($error->message)) {
            return $error->message;
        }

        return null;
    }
}

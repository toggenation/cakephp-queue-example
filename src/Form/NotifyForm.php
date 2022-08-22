<?php

declare(strict_types=1);

namespace App\Form;

use Cake\Form\Form;
use Cake\Form\Schema;
use Cake\Log\LogTrait;
use Cake\Validation\Validator;

/**
 * Notify Form.
 */
class NotifyForm extends Form
{
    use LogTrait;
    /**
     * Builds the schema for the modelless form
     *
     * @param \Cake\Form\Schema $schema From schema
     * @return \Cake\Form\Schema
     */
    protected function _buildSchema(Schema $schema): Schema
    {
        return $schema->addFields([
            'body' => [
                'type' => 'text'
            ],
            'subject' => ['type' => 'string']
        ]);
    }

    /**
     * Form validation builder
     *
     * @param \Cake\Validation\Validator $validator to use against the form
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator): Validator
    {
        return $validator->notEmptyString('subject')
            ->notEmptyString('body')
            ->notEmptyArray('users');
    }

    /**
     * Defines what to execute once the Form is processed
     *
     * @param array $data Form data.
     * @return bool
     */
    protected function _execute(array $data): bool
    {
        $this->log("Inside _execute " . print_r($data, true));
        return true;
    }
}

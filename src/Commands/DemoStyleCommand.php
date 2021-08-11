<?php

declare(strict_types=1);

namespace Pollen\Console\Commands;

use Pollen\Console\Command;
use Pollen\Validation\Validator as v;
use RuntimeException;

class DemoStyleCommand extends Command
{
    protected static $defaultName = 'demo:style';

    /**
     * @inheritDoc
     */
    protected function exec(): int
    {
        $this->title('Title example');
        $this->section('Section title example');

        $this->title('Content Text Methods');
        $this->section('Informational text');
        $this->text(
            [
                'Informational text #1',
                'Informational text #2',
            ]
        );
        $this->section('Comment text');
        $this->comment(
            [
                'Comment text #1',
                'Comment text #2',
            ]
        );
        $this->section('New lines (3 for example)');
        $this->newLine(3);

        $this->title('Listing Content Methods');
        $this->section('Listing');
        $this->listing(
            [
                'Element #1',
                'Element #2',
                'Element #3',
            ]
        );
        $this->section('Table');
        $this->table(
            ['Header 1', 'Header 2'],
            [
                ['Cell 1-1', 'Cell 1-2'],
                ['Cell 2-1', 'Cell 2-2'],
                ['Cell 3-1', 'Cell 3-2'],
            ]
        );
        $this->section('Horizontal Table');
        $this->horizontalTable(
            ['Header 1', 'Header 2'],
            [
                ['Cell 1-1', 'Cell 1-2'],
                ['Cell 2-1', 'Cell 2-2'],
                ['Cell 3-1', 'Cell 3-2'],
            ]
        );
        $this->section('Definition list');
        $this->definitionList(
            'Definition list title',
            ['foo1' => 'bar1'],
            ['foo2' => 'bar2'],
            ['foo3' => 'bar3'],
            $this->definitionListSeparator(),
            'Another definition list title',
            ['foo4' => 'bar4']
        );

        $this->title('Admonition Methods');
        $this->section('Note admonition');
        $this->note(
            [
                'Note #1',
                'Note #2',
            ]
        );
        $this->section('Caution admonition');
        $this->caution(
            [
                'Caution #1',
                'Caution #2',
            ]
        );

        $this->title('Result Methods');
        $this->section('Success result bar');
        $this->success(
            [
                'Success result #1',
                'Success result #2',
            ]
        );
        $this->section('Info message');
        $this->info(
            [
                'Info result #1',
                'Info result #2',
            ]
        );
        $this->section('Warning result bar');
        $this->warning(
            [
                'Warning result #1',
                'Warning result #2',
            ]
        );
        $this->section('Error result bar');
        $this->error(
            [
                'Error result #1',
                'Error result #2',
            ]
        );

        $this->title('User Input Methods');
        $this->section('Asks a question');
        $name = $this->ask('Please enter your name');
        $this->section('Asks a question - with default value');
        $country = $this->ask('Please enter your country', 'France');
        $this->section('Asks a question - with validator');
        $age = $this->ask(
            'Please enter your age',
            null,
            function ($age) {
                if (!is_numeric($age)) {
                    throw new RuntimeException('Age must be a number.');
                }

                return (int)$age;
            }
        );
        $this->text(
            [
                'Results : ',
                sprintf('Your name : %s, Your country : %s, Your age %d', $name, $country, $age),
            ]
        );
        $this->section('Asks question and hide answer');
        $password = $this->askHidden('Please enter a password');
        $this->text(
            [
                sprintf('Your type is : %s', $password),
            ]
        );
        $this->section('Asks question and hide answer - with validator');
        $validatedPassword = $this->askHidden(
            'Please enter a password with at least 1 number and at least 1 lowercase',
            function ($pass) {
                if (!v::password(
                    [
                        'digit'   => 1,
                        'lower'   => 1,
                        'max'     => 0,
                        'min'     => 0,
                        'special' => 0,
                        'upper'   => 0,
                    ]
                )->validate($pass)) {
                    throw new RuntimeException(
                        'Password requires at least 1 digit, at least 1 lowercase'
                    );
                }

                return $pass;
            }
        );
        $this->text(
            [
                sprintf('Your type is : %s', $validatedPassword),
            ]
        );
        $this->section('Asks for confirmation');
        $ok = $this->confirm('Are you OK today ?');

        if ($ok) {
            $this->text('Excellent news, today is really a good day !');
        } else {
            $this->text('Sorry, but courage tomorrow is another day !');
        }
        $this->section('Asks a choice question');
        $this->choice('What is your favorite PHP Framework ?', ['Laravel', 'Symfony', 'Other']);

        $this->title('Progress Bar Methods');
        $this->text([
            '1. Start a progress bar with 100 step',
            '2. Advance of 10 steps on each seconds',
            '3. Finally, finishing the progress bar.'
        ]);
        $this->progressStart(100);

        $i = 0;
        while($i < 10) {
            $i++;
            sleep(1);
            $this->progressAdvance(10);
        }

        $this->progressFinish();

        return $this::SUCCESS;
    }
}
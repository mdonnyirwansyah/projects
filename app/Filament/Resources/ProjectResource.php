<?php

namespace App\Filament\Resources;

use App\Models\Project;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Illuminate\Support\Str;
use Filament\Resources\Resource;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Model;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Actions\CreateAction;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Actions\ForceDeleteAction;
use Filament\Tables\Actions\RestoreBulkAction;
use App\Filament\Resources\ProjectResource\Pages;
use Filament\Tables\Actions\ForceDeleteBulkAction;

class ProjectResource extends Resource
{
    protected static ?string $model = Project::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make()->schema([
                    Section::make()
                        ->schema([
                            TextInput::make('name'),
                            Select::make('project_manager_id')
                                ->label('Project Manager')
                                ->relationship('projectManager', 'name')
                                ->preload()
                                ->searchable(),
                        ])
                        ->columns(2),
                    Textarea::make('description')->autosize(),
                    Repeater::make('projectUsers')
                        ->label('Teams')
                        ->relationship()
                        ->schema([
                            Select::make('user_id')
                                ->label('Name')
                                ->relationship('user', 'name')
                                ->preload()
                                ->searchable(),
                            Select::make('role_id')
                                ->label('Role')
                                ->relationship('role', 'name')
                                ->getOptionLabelFromRecordUsing(fn (Model $record) => Str::title(Str::replace('_', ' ', $record->name)))
                                ->preload()
                                ->searchable()
                        ])
                        ->cloneable()
                        ->columns(2),
                    Repeater::make('additionalInformations')
                        ->relationship()
                        ->schema([
                            TextInput::make('key'),
                            TextInput::make('value'),
                        ])
                        ->cloneable()
                        ->columns(2),
                ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->description(fn (Project $record): string|null => $record->description)
                    ->sortable()
                    ->searchable(),
                TextColumn::make('created_at')
                    ->since()
                    ->dateTimeTooltip()
                    ->sortable(),
                TextColumn::make('updated_at')
                    ->since()
                    ->dateTimeTooltip()
                    ->sortable(),
            ])
            ->filters([
                TrashedFilter::make(),
            ])
            ->actions([
                EditAction::make()
                    ->button()
                    ->iconButton()
                    ->outlined(),
                DeleteAction::make()
                    ->button()
                    ->iconButton()
                    ->outlined(),
                ForceDeleteAction::make()
                    ->button()
                    ->iconButton()
                    ->outlined(),
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                    ForceDeleteBulkAction::make(),
                    RestoreBulkAction::make(),
                ]),
            ])
            ->defaultSort('created_at')
            ->deferLoading()
            ->striped()
            ->emptyStateActions([
                CreateAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getNavigationGroup(): ?string
    {
        return 'PROJECT MANAGEMENTS';
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListProjects::route('/')
        ];
    }
}

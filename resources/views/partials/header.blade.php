<div class="pad-13 flex-col-13">
    <div class="flex-row-8">
        <div class="flex-row flex-grow">
            <div class="flex-col">
                <div class="flex-row-8 ai-end">
                    <p data-tooltip="«Остатки Будущего»">Remnants of the Future</p>
                    <p class="color-second font-sm cursor-help"
                        data-tooltip="Самая ранняя стадия разработки игры, когда создаются и тестируются базовые механики без готового контента и визуала">
                        Pre-Alpha</p>
                </div>

                <div class="flex-row-8">
                    <a class="link font-sm" href="{{ route('pages.main') }}" data-tooltip="Главная страница">Главная</a>
                    <a class="link font-sm" href="{{ route('pages.about') }}" data-tooltip="Подробности о проекте">О
                        игре</a>
                    <a class="link font-sm" href="{{ route('pages.lore') }}"
                        data-tooltip="История игрового мира">Лор</a>
                    <a class="link font-sm" href="{{ route('pages.gameplay') }}"
                        data-tooltip="Как выглядит игра">Геймплей</a>
                    <a class="link font-sm" href="{{ route('pages.gallery') }}" data-tooltip="Медиа-контент">Галерея</a>
                </div>
            </div>
        </div>

        <div class="flex-row ai-center">
            @if (auth()->check())
                <a class="icon d-flex d-md-none" href="{{ route('users.main') }}">
                    @component('components.icon', ['size' => 28, 'name' => 'user-male-circle', 'color' => 'FFFFFF'])
                    @endcomponent
                </a>

                <div class="flex-col d-none d-md-flex">
                    <p class="flex-row-8 jc-end ai-center text-end color-second ">
                        <span class="font-sm">Вы авторизовались как</span>
                        <a class="link text-end" href="{{ route('users.main') }}">{{ auth()->user()->login }}</a>
                    </p>

                    <div class="flex-row-8 jc-end ai-center">
                        @if (auth()->user()->currentCharacter())
                            <span class="color-second font-sm">
                                Текущий персонаж

                            <a class="link text-end font-pulse-brand"
                                href="{{ route('transitions.index') }}">{{ auth()->user()->currentCharacter()->getTitle() }}</a>
                            </span>
                        @else
                            @if (count(auth()->user()->characters) > 0)
                                <a class="link text-end font-sm font-pulse-brand"
                                    href="{{ route('characters.select') }}">Выбрать
                                    персонажа</a>
                            @else
                                <a class="link text-end font-sm font-pulse-brand"
                                    href="{{ route('characters.create') }}">Создать
                                    персонажа</a>
                            @endif
                        @endif
                    </div>
                </div>
            @else
                <div class="flex-col">
                    <p class="text-end">Добро пожаловать!</p>

                    <div class="flex-row-8 jc-end">
                        <a class="link text-end font-sm" href="{{ route('users.login') }}">Вход</a>
                        <span class="color-second font-sm">или</span>
                        <a class="link text-end font-sm" href="{{ route('users.register') }}">Регистрация</a>
                    </div>
                </div>
            @endif
        </div>
    </div>

    @component('partials.alerts')
    @endcomponent
</div>

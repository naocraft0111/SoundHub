<div>
    {{-- 年 --}}
    <select name="birth-year" wire:model="year" wire:change="onChange">
        <option>----</option>
        @for($i = 1900; $i <= date('Y'); $i++)
        <option value="{{ $i }}">{{ $i }}</option>
        @endfor
    </select>
    <label for="birth-year">年</label>

    {{-- 月 --}}
    <select name="birth-month" wire:model="month" wire:change="onChange">
        <option>----</option>
        @for($i = 1; $i <= 12; $i++)
        <option value="{{ $i }}">{{ $i }}</option>
        @endfor
    </select>
    <label for="birth-month">月</label>

    {{-- 日 --}}
    <select name="birth-day" wire:model="day" wire:change="onChange">
        <option>----</option>
        @for($i = 1; $i <= $last_day_of_month; $i++)
        <option value="{{ $i }}">{{ $i }}</option>
        @endfor
    </select>
    <label for="birth-day">日</label>

    {{-- 年齢 --}}
    @if ($age > -1)
        <input name="age" type="hidden" value="{{ $age }}">
    @endif
</div>

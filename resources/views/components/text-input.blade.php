@props(['disabled' => false])

<input @disabled($disabled) {{ $attributes->merge(['class' => 'rounded-xl border-slate-300 bg-white text-slate-900 shadow-sm placeholder:text-slate-400 focus:border-teal-500 focus:ring-teal-500 dark:border-gray-700 dark:bg-gray-950 dark:text-gray-100 dark:focus:border-teal-500 dark:focus:ring-teal-500']) }}>

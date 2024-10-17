<div class="bg-white py-10 sm:py-10">
  <div class="mx-auto max-w-7xl px-6 lg:px-8">
    <dl class="grid grid-cols-1 gap-x-8 gap-y-8 text-center lg:grid-cols-3">
      <div class="mx-auto flex max-w-xs flex-col gap-y-4">
        <dt class="text-base leading-7 text-gray-600">Total Income</dt>
        <dd class="order-first text-3xl font-semibold tracking-tight text-gray-900 sm:text-4xl">Rp {{$totalIncome}}</dd>
      </div>
      <div class="mx-auto flex max-w-xs flex-col gap-y-4">
        <dt class="text-base leading-7 text-gray-600">Total Outcome</dt>
        <dd class="order-first text-3xl font-semibold tracking-tight text-gray-900 sm:text-4xl">Rp {{$totalOutcome}}</dd>
      </div>
      <div class="mx-auto flex max-w-xs flex-col gap-y-4">
        <dt class="text-base leading-7 text-gray-600">Monthly Savings</dt>
        <dd class="order-first text-3xl font-semibold tracking-tight text-gray-900 sm:text-4xl">Rp {{$diff}}</dd>
      </div>
    </dl>
  </div>
</div>
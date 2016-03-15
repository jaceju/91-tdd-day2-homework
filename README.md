# 自動測試與 TDD 實務開發 第五梯 - Day 2 作業

其實這份作業在之前第一次上課後，我就有用 [PHPUnit](https://phpunit.de/) 練習寫過。不過這次我想改用 [PHPSpec](https://www.phpspec.net/) 重新練習，熟悉一下不同的自動化測試框架。

## 規格

哈利波特一到五冊熱潮正席捲全球，世界各地的孩子都為之瘋狂。

出版社為了慶祝 TDD 課程招生順利，決定訂出極大的優惠，來回饋給為了小孩四處奔波買書的父母親們。

定價的方式如下：

1. 一到五集的哈利波特，每一本都是賣 100 元。
2. 如果你從這個系列買了兩本不同的書，則會有 5% 的折扣。
3. 如果你買了三本不同的書，則會有 10% 的折扣。
4. 如果是四本不同的書，則會有 20% 的折扣。
5. 如果你一次買了整套一到五集，恭喜你將享有 25% 的折扣。
6. 需要留意的是，如果你買了四本書，其中三本不同，第四本則是重複的，那麼那三本將享有 10% 的折扣，但重複的那一本，則仍須 100 元。

你的任務是，設計一個哈利波特的購物車，能提供最便宜的價格給這些爸爸媽媽。

哈利波特前五集分別是：

1. 《哈利波特：神秘的魔法石》
1. 《哈利波特：消失的密室》
1. 《哈利波特：阿茲卡班的逃犯》
1. 《哈利波特：火盃的考驗》
1. 《哈利波特：鳳凰會的密令》

## 驗證範例

```gherkin
Feature: PotterShoppingCart
	In order to 提供最便宜的價格給來買書的爸爸媽媽
	As a 佛心的出版社老闆
	I want to 設計一個哈利波特的購物車

Scenario: 第一集買了一本，其他都沒買，價格應為 (100 * 1) = 100 元
	Given 第一集買了 1 本
	And 第二集買了 0 本
	And 第三集買了 0 本
	And 第四集買了 0 本
	And 第五集買了 0 本
	When 結帳
	Then 價格應為 100 元

Scenario: 第一集買了一本，第二集也買了一本，價格應為 (100 * 2 * 0.95) = 190
	Given 第一集買了 1 本
	And 第二集買了 1 本
	And 第三集買了 0 本
	And 第四集買了 0 本
	And 第五集買了 0 本
	When 結帳
	Then 價格應為 190 元

Scenario: 一二三集各買了一本，價格應為 (100 * 3 * 0.9) = 270
	Given 第一集買了 1 本
	And 第二集買了 1 本
	And 第三集買了 1 本
	And 第四集買了 0 本
	And 第五集買了 0 本
	When 結帳
	Then 價格應為 270 元

Scenario: 一二三四集各買了一本，價格應為 (100 * 4 * 0.8) = 320
	Given 第一集買了 1 本
	And 第二集買了 1 本
	And 第三集買了 1 本
	And 第四集買了 1 本
	And 第五集買了 0 本
	When 結帳
	Then 價格應為 320 元

Scenario: 一次買了整套，一二三四五集各買了一本，價格應為 (100 * 5 * 0.75) = 375
	Given 第一集買了 1 本
	And 第二集買了 1 本
	And 第三集買了 1 本
	And 第四集買了 1 本
	And 第五集買了 1 本
	When 結帳
	Then 價格應為 375 元

Scenario: 一二集各買了一本，第三集買了兩本，價格應為 (100 * 3 * 0.9) + 100 = 370
	Given 第一集買了 1 本
	And 第二集買了 1 本
	And 第三集買了 2 本
	And 第四集買了 0 本
	And 第五集買了 0 本
	When 結帳
	Then 價格應為 370 元

Scenario: 第一集買了一本，第二三集各買了兩本，價格應為 (100 * 3 * 0.9) + ( 100 * 2 * 0.95) = 460
	Given 第一集買了 1 本
	And 第二集買了 2 本
	And 第三集買了 2 本
	And 第四集買了 0 本
	And 第五集買了 0 本
	When 結帳
	Then 價格應為 460 元
```

## 分析

這次的程式有三個角色：

1. `Book`
1. `DiscountCalculator`
1. `BookStore`

不過 `BookStore` 的角色可以用測試程式取代，所以就只保留 `Book` 及 `DiscountCalculator` 。

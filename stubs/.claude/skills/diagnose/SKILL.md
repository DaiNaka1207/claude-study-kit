---
description: 学習プランを再生成する。通常は /study から自動的に呼ばれる。トピックを変えたい・プランを作り直したいときに単体で使う
---

# /diagnose — 学習プラン再生成

> 通常は `/study` を実行すれば自動的にこの処理が行われます。
> トピックを変えたい・学習プランを作り直したい場合に単体で使ってください。

# /diagnose — プロジェクト解析 & 学習プラン生成

## あなたのタスク

### Step 1: プロジェクト構成の把握

以下のファイルを存在するものから読む。

**依存関係・設定ファイル:**
```
composer.json / composer.lock
package.json / package-lock.json / yarn.lock
Gemfile / Gemfile.lock
go.mod
requirements.txt / pyproject.toml / Pipfile
Cargo.toml
*.csproj / *.sln
```

**ソースコード構成（ディレクトリ一覧で把握）:**
```
src/ app/ lib/ internal/ pkg/ components/ pages/ routes/
tests/ spec/ __tests__/
```

**設定・インフラ:**
```
.env.example
docker-compose.yml / Dockerfile
.github/workflows/
```

### Step 2: ユーザーへのヒアリング

コード解析結果を共有した上で、以下を質問する。

**現在の理解レベル（1問ずつ聞く）:**
1. 「{検出した主要言語・フレームワーク}はどの程度使いこなせていますか？（初心者 / ある程度わかる / 実務レベル）」
2. 「一番自信がない・苦手だと感じる部分はどこですか？」
3. 「このプロジェクトで特に強化したいスキルは何ですか？」

### Step 3: LEARNING_PLAN.md の生成

ヒアリング結果をもとに `.study/topics/01_{topic}/LEARNING_PLAN.md` を生成する。

構成は技術スタックに応じて決定するが、以下の3フェーズ構造を基本とする：

```markdown
# LEARNING_PLAN: {トピック名}

## 概要
{このトピックで何を学ぶかの説明}

## フェーズ1: 基礎固め（入門・基礎）
- [ ] {基礎項目1}
- [ ] {基礎項目2}
...

## フェーズ2: 実践（基礎・応用）
- [ ] {実践項目1}
- [ ] {実践項目2}
...

## フェーズ3: 応用・深化（応用）
- [ ] {応用項目1}
- [ ] {応用項目2}
...
```

**重要:** タスクは抽象的な練習問題ではなく、プロジェクトの実際のコードや機能に関連付けること。
例：「認証機能のバリデーションを実装する」「既存のサービスクラスにユニットテストを追加する」

### Step 4: PROGRESS.md の初期化

`.study/topics/01_{topic}/PROGRESS.md` を作成する。

```markdown
# PROGRESS: {トピック名}

## 評価履歴

| 日付 | タスク | レベル | ヒント回数 | コメント |
|------|--------|--------|-----------|----------|

## トレンド分析

（レビューが積み重なったらここに傾向を記載）
```

### Step 5: current_session.md の更新

```
Session Date: {今日の日付}
Status: Ready
Current Topic: 01_{topic}
Current Task: (未割当)
Last Updated: {今日の日付}
```

### Step 6: ユーザーへの報告と次のアクション

生成した学習プランをユーザーに見せ、修正の要否を確認する。
合意が得られたら「`/study` を実行するとセッションが始まり、最初のタスクが割り当てられます」と案内する。

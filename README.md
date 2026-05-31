# claude-study-kit

Claude Code を使った学習環境をどんなプロジェクトにも追加できる composer パッケージです。

## 特徴

- **任意の技術スタックに対応** — PHP / JS / Ruby / Go / Python など
- **`/study` 一発セットアップ** — 既存の `CLAUDE.md` に学習セクションを加筆。新規作成も可能
- **試験官スタイル固定** — Claude Code はコードを書かず、質問でユーザーを導く
- **適応的タスク選択** — 理解度レベル（A〜D）に応じて次のタスクが自動決定される
- **プロジェクトのコードが教材** — 抽象的な練習問題ではなく、実際のコードベースを使って学ぶ

## インストール

```bash
composer require dainaka1207/claude-study-kit --dev
```

インストール後、以下のファイルがプロジェクトルートに展開されます：

```
.claude/skills/study/SKILL.md     → /study コマンド
.claude/skills/hint/SKILL.md      → /hint コマンド
.claude/skills/review/SKILL.md    → /review コマンド
.claude/skills/next/SKILL.md      → /next コマンド
.claude/skills/diagnose/SKILL.md  → /diagnose コマンド
.study/_session/current_session.md
.study/_templates/TASK_template.md
.study/_templates/REVIEW_template.md
```

> 既存ファイルは上書きされません。

## 使い方

### 1. Claude Code を起動

```bash
claude
```

### 2. `/study` を実行する

```
/study
```

以下を一気に行います：
1. `CLAUDE.md` に学習セクションを追記（または更新）
2. プロジェクトのコードを解析して技術スタックを把握
3. 理解レベルをヒアリングして学習プランを自動生成
4. 最初のタスクを割り当てて学習開始

### 3. 学習サイクル

```
/study      → セッション開始・タスク割り当て（2回目以降は状態を復元）
（自力で実装する）
/hint 〇〇   → 詰まったらヒントをもらう（答えは教えてもらえない）
/review     → 完成したらレビューを依頼
/next       → 次のタスクへ
```

## コマンド一覧

| コマンド | 説明 |
|---------|------|
| `/study` | 初回：CLAUDE.md更新 → プロジェクト解析 → 学習プラン生成 → タスク出題まで一気に実行。2回目以降：前回状態を復元してセッション再開 |
| `/diagnose` | 学習プランだけを再生成したいときに単体で使う |
| `/hint [詰まっている箇所]` | 質問形式でヒントをもらう（コードは教えてもらえない） |
| `/review [ファイルパス]` | 提出物のレビューと理解度評価（A〜D） |
| `/next` | 理解度に応じた次のタスクを割り当て |

## 学習ファイルの管理

`.study/` ディレクトリに学習記録が蓄積されます。
個人の記録として手元だけに残したい場合は `.gitignore` に追加してください：

```bash
echo ".study/" >> .gitignore
```

## ライセンス

MIT
